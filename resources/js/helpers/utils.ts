export function getBasePath(url: string): string {
  return url.split('?')[0];
}
