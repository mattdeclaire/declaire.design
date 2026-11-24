import { defineCollection, type SchemaContext } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

// Projects and concept designs share one format: one folder per item holding
// index.md plus its photos. See CLAUDE.md for the format.
const projectSchema = ({ image }: SchemaContext) =>
  z.object({
    title: z.string(),
    location: z.string().optional(),
    year: z.number().int().optional(),
    summary: z.string().optional(),
    cover: image(),
    coverAlt: z.string(),
    coverCaption: z.string().optional(),
    images: z
      .array(z.object({ src: image(), alt: z.string(), group: z.string().optional(), caption: z.string().optional() }))
      .default([]),
    // Optional before and after pairs, shown in their own section on the project page.
    beforeAfter: z
      .array(
        z.object({
          room: z.string(),
          before: image(),
          beforeAlt: z.string(),
          after: image(),
          afterAlt: z.string(),
        }),
      )
      .default([]),
    services: z.array(z.string()).default([]),
    featured: z.boolean().default(false),
    draft: z.boolean().default(false),
    order: z.number().default(100),
  });

// Built portfolio projects (src/content/projects/).
const projects = defineCollection({
  loader: glob({ pattern: '*/index.md', base: './src/content/projects' }),
  schema: projectSchema,
});

// Concept designs: unbuilt proposals, shown on their own "Concept Designs" tab
// (src/content/concepts/). Never mixed in with built projects.
const concepts = defineCollection({
  loader: glob({ pattern: '*/index.md', base: './src/content/concepts' }),
  schema: projectSchema,
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

export const collections = { projects, concepts, pages };
