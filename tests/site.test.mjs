// Smoke tests for the built site in dist/.
//
// Run with `npm test`, which builds the site first. Uses only Node's built-in
// test runner, so there's nothing extra to install.
//
// What this catches:
// - a page or project that fails to build, or is missing from the output
// - a draft project that leaks onto the live site
// - links and images that point at files that don't exist
// - images with no alt text, pages with no title or more than one main heading
// - working notes ("TODO", "to come", "Katie to confirm"…) showing as page text

import { test } from 'node:test';
import assert from 'node:assert/strict';
import { existsSync, readdirSync, readFileSync, statSync } from 'node:fs';
import { join, relative, sep } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = fileURLToPath(new URL('..', import.meta.url));
const dist = join(root, 'dist');

// Same base path the build used (see astro.config.mjs), without a trailing slash.
const base = (process.env.BASE_PATH || '/').replace(/\/+$/, '');

if (!existsSync(join(dist, 'index.html'))) {
  throw new Error('dist/ has no built site. Run `npm test` (it builds first) or `npm run build`.');
}

// Every built HTML page, as { file, path, html }. `path` is the address a
// visitor would use, such as "/work/modern-home/".
const pages = walk(dist)
  .filter((file) => file.endsWith('.html'))
  .map((file) => {
    const rel = relative(dist, file).split(sep).join('/');
    const path = '/' + rel.replace(/(^|\/)index\.html$/, '$1');
    return { file, rel, path, html: readFileSync(file, 'utf8') };
  });

function walk(dir) {
  return readdirSync(dir).flatMap((name) => {
    const full = join(dir, name);
    return statSync(full).isDirectory() ? walk(full) : [full];
  });
}

function page(path) {
  return pages.find((p) => p.path === path);
}

// Text a visitor sees: no scripts, styles, comments or tags.
function visibleText(html) {
  return html
    .replace(/<script[\s\S]*?<\/script>/gi, ' ')
    .replace(/<style[\s\S]*?<\/style>/gi, ' ')
    .replace(/<!--[\s\S]*?-->/g, ' ')
    .replace(/<[^>]+>/g, ' ')
    .replace(/&nbsp;/g, ' ')
    .replace(/\s+/g, ' ');
}

// Published (non-draft) and draft entries in a content folder.
function contentEntries(folder) {
  const dir = join(root, 'src/content', folder);
  if (!existsSync(dir)) return { published: [], drafts: [] };
  const published = [];
  const drafts = [];
  for (const slug of readdirSync(dir)) {
    const md = join(dir, slug, 'index.md');
    if (!existsSync(md)) continue;
    const frontMatter = readFileSync(md, 'utf8').split(/^---\s*$/m)[1] ?? '';
    (/^draft:\s*true\s*$/m.test(frontMatter) ? drafts : published).push(slug);
  }
  return { published, drafts };
}

// Content folder -> where its pages live on the site.
const collections = [
  { folder: 'projects', route: '/work' },
  { folder: 'concepts', route: '/concepts' },
];

test('the main pages are built', () => {
  for (const path of ['/', '/about/', '/contact/', '/work/']) {
    assert.ok(page(path), `${path} is missing from the build`);
  }
  assert.ok(existsSync(join(dist, '404.html')), '404.html is missing from the build');
});

for (const { folder, route } of collections) {
  const { published, drafts } = contentEntries(folder);
  if (published.length === 0 && drafts.length === 0) continue;

  test(`every published item in src/content/${folder} has its own page`, () => {
    for (const slug of published) {
      assert.ok(page(`${route}/${slug}/`), `${route}/${slug}/ was not built`);
    }
  });

  test(`${route}/ links to every published item in src/content/${folder}`, () => {
    const index = page(`${route}/`);
    assert.ok(index, `${route}/ was not built`);
    for (const slug of published) {
      const href = `${base}${route}/${slug}`;
      assert.match(index.html, new RegExp(`href="${href}/?"`), `${route}/ has no link to ${slug}`);
    }
  });

  test(`drafts in src/content/${folder} stay off the site`, () => {
    for (const slug of drafts) {
      assert.equal(page(`${route}/${slug}/`), undefined, `draft ${slug} was published at ${route}/${slug}/`);
      for (const p of pages) {
        assert.doesNotMatch(p.html, new RegExp(`href="${base}${route}/${slug}/?"`), `${p.path} links to draft ${slug}`);
      }
    }
  });
}

test('every page has a title, one main heading and a language', () => {
  for (const { path, html } of pages) {
    assert.match(html, /<html[^>]*\slang="[^"]+"/, `${path} has no lang on <html>`);
    assert.match(html, /<title>[^<\s][^<]*<\/title>/, `${path} has no <title>`);
    if (path === '/404.html') continue;
    const h1s = html.match(/<h1[\s>]/g) ?? [];
    assert.equal(h1s.length, 1, `${path} has ${h1s.length} <h1> headings, expected 1`);
  }
});

test('every image has alt text', () => {
  for (const { path, html } of pages) {
    for (const img of html.match(/<img\b[^>]*>/g) ?? []) {
      assert.match(img, /\salt="[^"]*"/, `${path} has an image with no alt attribute: ${img.slice(0, 120)}`);
    }
  }
});

test('working notes never show up as page text', () => {
  // Notes belong in code comments (see CLAUDE.md), never in what visitors read.
  const notes = [
    /\bTODO\b/,
    /\bTBD\b/,
    /\bFIXME\b/,
    /lorem ipsum/i,
    /\[[^\]]*\]/, // anything in square brackets, like "[Story to come]"
    /\bto (?:be )?confirm(?:ed)?\b/i,
    /\bplaceholder\b/i,
  ];
  for (const { path, html } of pages) {
    const text = visibleText(html);
    for (const note of notes) {
      const match = text.match(note);
      const context = match && text.slice(Math.max(0, match.index - 40), match.index + match[0].length + 40).trim();
      assert.ok(!match, `${path} shows a working note to visitors: "…${context}…"`);
    }
  }
});

test('internal links and images point at files that exist', () => {
  const broken = [];
  for (const { path, rel, html } of pages) {
    const refs = [...html.matchAll(/\s(?:href|src)="([^"]+)"/g)].map((m) => m[1]);
    for (const ref of refs) {
      if (/^(?:[a-z]+:|\/\/|#)/i.test(ref)) continue; // external, mailto:, data:, anchors
      const target = resolveRef(ref, rel);
      if (target === null) continue;
      if (!existsInDist(target)) broken.push(`${path} -> ${ref}`);
    }
  }
  assert.deepEqual(broken, [], `Broken links or images:\n  ${broken.join('\n  ')}`);
});

// Turns a link into a path inside dist/, or null if it's outside the site.
function resolveRef(ref, fromRel) {
  const clean = decodeURI(ref.split(/[?#]/)[0]);
  if (clean === '') return null;
  if (clean.startsWith('/')) {
    if (base && clean !== base && !clean.startsWith(`${base}/`)) return clean; // outside base: report it
    return clean.slice(base.length) || '/';
  }
  const fromDir = '/' + fromRel.split('/').slice(0, -1).join('/');
  return new URL(clean, `http://x${fromDir.endsWith('/') ? fromDir : fromDir + '/'}`).pathname;
}

function existsInDist(sitePath) {
  const p = join(dist, sitePath);
  if (sitePath.endsWith('/')) return existsSync(join(p, 'index.html'));
  return existsSync(p) || existsSync(join(p, 'index.html')) || existsSync(`${p}.html`);
}
