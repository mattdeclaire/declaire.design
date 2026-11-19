import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

// Portfolio projects. One folder per project in src/content/projects/,
// holding index.md plus its photos. See CLAUDE.md for the format.
const projects = defineCollection({
  loader: glob({ pattern: '*/index.md', base: './src/content/projects' }),
  schema: ({ image }) =>
    z.object({
      title: z.string(),
      location: z.string().optional(),
      year: z.number().int().optional(),
      summary: z.string().optional(),
      cover: image(),
      coverAlt: z.string(),
      images: z
        .array(z.object({ src: image(), alt: z.string() }))
        .default([]),
      services: z.array(z.string()).default([]),
      featured: z.boolean().default(false),
      draft: z.boolean().default(false),
      order: z.number().default(100),
    }),
});

// Text pages (About, Services, Contact). One Markdown file each.
const pages = defineCollection({
  loader: glob({ pattern: '*.md', base: './src/content/pages' }),
  schema: z.object({
    title: z.string(),
    description: z.string(),
    heading: z.string().optional(),
  }),
});

export const collections = { projects, pages };
