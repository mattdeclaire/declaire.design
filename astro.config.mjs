// @ts-check
import { defineConfig } from 'astro/config';

// The deploy workflow sets SITE_URL and BASE_PATH from GitHub Pages.
// Before launch the site is served from mattdeclaire.github.io/declaire.design
// (base "/declaire.design"); after launch it's declaire.design (base "/").
export default defineConfig({
  site: process.env.SITE_URL || 'https://declaire.design',
  base: process.env.BASE_PATH || '/',
  trailingSlash: 'ignore',
});
