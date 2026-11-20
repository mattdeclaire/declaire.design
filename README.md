# declaire.design

The website for DeClaire Design, Katie DeClaire's interior design studio in the San Francisco Bay Area.

A static [Astro](https://astro.build) site. All content is in Markdown under `src/content/`, and it's deployed to GitHub Pages by `.github/workflows/deploy.yml` on every push to `main`. Pull requests run the build as a check.

- **For Katie:** start with [brain/working-with-claude.md](brain/working-with-claude.md).
- **For Claude:** start with [CLAUDE.md](CLAUDE.md) and [brain/](brain/).
- **Develop:** `npm install`, then `npm run dev`.

## Hosting notes (Matt)

- **GitHub Pages:** in Settings → Pages, set the source to **GitHub Actions**. Until launch, the site is served at `https://mattdeclaire.github.io/declaire.design/`. The workflow sets `SITE_URL` and `BASE_PATH` from the Pages settings, so links work there and on the custom domain.
- **Branch protection:** require a pull request and a passing build check before merging to `main`.
- **Launch:** remove the `declaire.design` custom domain from the `declaire.design.ai` repo's Pages settings, then add it here (this creates `public/CNAME` through the settings, or add the file by hand). DNS already points at GitHub Pages. **Never change the MX or TXT records**, which carry Katie's Google Workspace email.
- **Known gap before launch:** `site.webmanifest` icon paths assume the site is at the domain root, so they only resolve after the custom domain is set.
