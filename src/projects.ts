import { getCollection } from 'astro:content';

// Published projects, in display order.
export async function getProjects() {
  const all = await getCollection('projects', ({ data }) => !data.draft);
  return all.sort((a, b) => a.data.order - b.data.order || (b.data.year ?? 0) - (a.data.year ?? 0));
}

// Published concept designs, in display order.
export async function getConcepts() {
  const all = await getCollection('concepts', ({ data }) => !data.draft);
  return all.sort((a, b) => a.data.order - b.data.order || (b.data.year ?? 0) - (a.data.year ?? 0));
}

// Published journal posts, newest first.
export async function getPosts() {
  const all = await getCollection('journal', ({ data }) => !data.draft);
  return all.sort((a, b) => b.data.date.getTime() - a.data.date.getTime());
}
