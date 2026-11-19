# Decisions

Newest first. Each entry: what we decided, why, and who decided.

## 2026-11-19: Fresh repo, Astro, GitHub Pages (Matt)

- **Static Astro site.** Pages are plain HTML and CSS, and content lives in Markdown files that Claude can edit safely. The content schema in `src/content.config.ts` makes the build fail with a clear message if a project is missing a required field, instead of quietly breaking a page.
- **Hosted on GitHub Pages.** Free, with a custom domain and HTTPS. There are no per-change preview links, so `main` is the live site. Every change goes through a pull request that Matt reviews.
- **No CMS, database or login.** Claude is the editor. A previous attempt with a custom CMS (2025–26) was more to maintain than it was worth.
- **Fresh repo** rather than reusing an earlier one, so old code and photo history (some with GPS data) stay behind.
- **Design first in Claude Design,** then build from its handoff spec. Katie owns the design and content. Matt owns hosting, DNS and code review.

## Constraints that come from these decisions

- No server-side code. A contact form has to post to a hosted form service.
- At most two Google Fonts families.
- CSS-only motion, respecting `prefers-reduced-motion`.
- Every color, font, size and spacing value is a token in `src/styles/tokens.css`.
- WCAG AA contrast, visible focus states, alt text on every image.
