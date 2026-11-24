# CLAUDE.md

This is the website for **DeClaire Design**, Katie DeClaire's interior design business, at declaire.design. **Read `brain/` first:** it holds the business context, brand, content status and decisions.

## Who you're working with

- **Katie** owns the site's design and content. She's a designer, not a developer. Talk with her in plain language, show her results rather than code, and never ask her to run commands. When she tells you something lasting about her business, brand or preferences, record it in `brain/`.
- **Matt** handles hosting, DNS and code review. Ask him (through Katie, or in the pull request) before anything on the "check with Matt" list below.

## Where things live

| To change… | Edit… |
| --- | --- |
| A project | `src/content/projects/<project>/index.md` and the photos next to it |
| About or Contact text (add a Services page once Katie confirms the list) | `src/content/pages/<page>.md` |
| Business name, tagline, email, Instagram, menu | `src/settings.json` |
| Colors, fonts, sizes, spacing | `src/styles/tokens.css` |
| Page layouts and components | `src/pages/`, `src/layouts/`, `src/components/` |
| Business context, brand, decisions | `brain/` |
| The brief for designing in Claude Design | `brain/design-brief.md` |
| How Katie sets up and works with Claude (walk her through it when she asks) | `brain/working-with-claude.md` |

Most requests touch only `src/content/`, `src/settings.json`, `src/styles/tokens.css` and `brain/`.

### Adding a project

1. Create `src/content/projects/<short-name>/` (lowercase, hyphens: `tahoe-cabin`). The folder name becomes the page address.
2. Put the photos in it, named in order (`01.jpg`, `02.jpg`…). Before committing, **strip GPS and location data** from every photo and keep each file under about 2 MB. Astro resizes them for the web on its own.
3. Write `index.md` following an existing project. Required: `title`, `cover`, `coverAlt`. Optional: `location`, `year`, `summary`, `images`, `services`, `featured`, `draft`, `order`.
4. Write real alt text for every photo: describe what's in the room in one sentence.
5. Use `draft: true` to keep a project off the site while it's in progress.

## Rules

- **Never invent facts about Katie or her work:** credentials, experience, quotes, clients, testimonials, awards. Leave it out and ask her. Use `draft: true` to hold back a project that isn't ready.
- **Notes are never visitor-facing.** The site is live, so anything like "[Story to come]" or "Katie to confirm" goes in a code comment, never in page text. In Markdown front matter use a YAML comment (`# TODO(Katie): …`); in `.astro`, `.ts` and `.css` files use that language's comment.
- **No client names, addresses or identifying details** unless Katie says they're public. This repository is public.
- **No stock photos or other designers' work** presented as hers.
- **Accessibility:** WCAG AA contrast, visible focus states, alt text on every image, and the menu has to work on a phone and with a keyboard.
- **Use the tokens.** No hard-coded colors, fonts or sizes in components: add or change a token in `tokens.css`.
- **Motion** is subtle, CSS-only, and respects `prefers-reduced-motion`.
- **Static only.** No server code, database, login or client-side framework. Small scripts are fine.

## How changes ship

`main` is the live site, and GitHub Pages has no preview links.

1. **One session, one pull request.** At the start of each session (each chat thread), create a new branch from the latest `main` and open your own pull request for it. Push all of that session's work to that branch only. Never push to `main`, and never push to a branch or pull request that another session opened, even if it's still open. If your work depends on another session's unmerged pull request, branch from that pull request's branch and say so at the top of your pull request's description.
2. Run `npm run build`. It type-checks and builds, and fails with a clear message if content is missing a required field. Fix anything it reports.
3. Run `npm run dev` and check the change at phone and desktop widths. Show Katie a screenshot if you can.
4. Open the pull request with a short, plain-English summary of what changed and why, written so Katie and Matt can both follow it, and give Katie its link in the chat. As the session goes on, keep the summary up to date.
5. Matt reviews and merges. The site updates a minute or two after merging.

## Check with Matt first

- Adding or upgrading dependencies (`package.json`)
- Anything in `astro.config.mjs`, `.github/`, `tsconfig.json` or `public/CNAME`
- Domains, DNS, hosting or analytics
- Anything that collects visitor data, such as forms or tracking
- Deleting a project or page

## Commands

```bash
npm install       # once, after cloning
npm run dev       # local preview at http://localhost:4321
npm run build     # type-check and build to dist/
npm run preview   # serve the built site
```
