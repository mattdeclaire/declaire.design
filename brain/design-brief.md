# Design brief

For Claude, when working with Katie in Claude Design on the look of the site. Read the rest of `brain/` and `CLAUDE.md` too: they hold the business facts, the brand history, what content is confirmed, and the rules for content.

Katie is a designer, not a developer. Talk with her in plain language and show her visuals rather than code.

## What to make

1. **The design.** Work with Katie on the look and layout until she's happy. Use real content and her photos, not lorem ipsum. Show phone and desktop versions.
2. **A handoff spec.** List the design tokens, every page and reusable component, how layouts change between phone and desktop, and any interactions.
3. **Then the build,** in Claude Code in this repo, following `CLAUDE.md`. Don't write production code in Claude Design.

## Pages

Home, Work (a grid of projects), a project page, About, Services, and Contact.

The live site has no Services page yet, because Katie hasn't confirmed her list (draft in [business.md](business.md)). Design one anyway.

## Technical limits

These come from how the site is built (see [decisions.md](decisions.md)). The design has to fit them.

- **Static site.** Astro on GitHub Pages: no server, database, login, shopping cart, booking system or CMS. Every page works as plain HTML and CSS, with JavaScript only for small touches.
- **Templates, not one-off pages.** All content is Markdown. Each project has a title, location, year, cover photo, gallery photos with alt text, a short story, the services involved, and a featured flag. Site-wide details (name, tagline, email, Instagram, menu) live in one settings file.
- **The project page** has to work with 1 to 15 photos, a mix of portrait and landscape, and long or short titles and stories. Show it with at least two projects.
- **Contact** is an email link, or a short form that posts to a hosted form service. Form fields: name, email, phone, "How did you hear about me?" and "How can I help you?"
- **Mobile first,** then tablet and desktop. The menu has to work on a phone and with a keyboard.
- **Accessible.** WCAG AA text contrast, visible focus states, alt text on every photo.
- **At most two font families,** from Google Fonts.
- **Subtle, CSS-only motion.** No autoplay video, heavy parallax or animation libraries. Respect reduced-motion settings.
- **Named design tokens** for colors, fonts, type sizes and spacing. They become the CSS variables in `src/styles/tokens.css`, so "make the accent a little warmer" is a one-line change.

## Content to work from

| What | Where |
| --- | --- |
| Business facts, Katie's own bio, draft services | [business.md](business.md) |
| Voice, past palettes and type | [brand.md](brand.md) |
| What's confirmed and what's still open | [content-status.md](content-status.md) |
| Site name, tagline, email, Instagram, menu | `src/settings.json` |
| About and Contact copy | `src/content/pages/` |
| Two finished projects, with photos and alt text | `src/content/projects/` |
| Headshot | `src/assets/katie.jpg` |
| 2023 logo (188 × 80, small) | [assets/logo-2023.png](assets/logo-2023.png) |

Photos for Tahoe Cabin and the two client-named projects aren't in the repo yet (see content-status.md). Katie can attach them in the design session.

Earlier calls to action Katie may want to reuse:

- "Reach out today, and let's get started."
- After a form is sent: "Thanks so much. I'll get back to you as soon as I can."

## In the design (not on the live site)

Placeholders are fine in the design while Katie decides, as long as they're obvious, like [Bio to come]. The rules in `CLAUDE.md` still apply: no invented facts about Katie, no client names, no stock photos presented as hers. Label any stand-in image clearly.

When Katie settles on a direction, record it in [brand.md](brand.md) with her reasons.
