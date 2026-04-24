export function getBasePath(url: string): string {
  const hasProtocol = url.includes('://');
  const basePath = url.split('?')[0];

  if (!hasProtocol) {
    return basePath;
  }

  const { pathname } = new URL(url);
  return pathname;
}
