// Builds a link that works both on declaire.design and on the
// mattdeclaire.github.io/declaire.design test address.
export function url(path: string): string {
  const base = import.meta.env.BASE_URL.replace(/\/$/, '');
  return `${base}${path.startsWith('/') ? path : `/${path}`}`;
}
