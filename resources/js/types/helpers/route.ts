type RouteParameters = {
  home: never;
  'products.search': never;
  'products.show': {
    product: string | number;
  };
  'auth.sign-up.create': never;
  'auth.sign-up.store': never;
  'auth.login.create': never;
  'auth.login.store': never;
  'auth.login.destroy': never;
  'auth.forgot-password.create': never;
  'auth.forgot-password.store': never;
  'auth.reset-password.create': never;
  'auth.reset-password.store': never;
  'cart.show': never;
  'cart.checkout': never;
  'cart.items.store': never;
  'cart.items.sync': never;
  'account.orders.index': never;
  'account.orders.show': {
    orderId: string | number;
  };
  'account.profile.edit': never;
  'account.profile.update': never;
  'account.wishlist': never;
  'account.wishlist.toggle': never;
  'about-us': never;
  contact: never;
  'storage.local.upload': {
    path: string | number;
  };
};
export function route<T extends keyof RouteParameters>(
  name: T,
  parameters?: [RouteParameters[T]] extends [never] ? Record<string, never> : RouteParameters[T],
  absolute: boolean = true,
): string {
  let url: string = '/' + routes[name];

  if (parameters) {
    for (const [key, value] of Object.entries(parameters)) {
      url = url.replace(`{${key}}`, String(value));
    }
  }

  if (absolute) {
    url = window.location.origin + url;
  }

  return url;
}
const routes = {
  home: '/',
  'products.search': 'products/search',
  'products.show': 'products/{product}',
  'auth.sign-up.create': 'sign-up',
  'auth.sign-up.store': 'sign-up',
  'auth.login.create': 'login',
  'auth.login.store': 'login',
  'auth.login.destroy': 'logout',
  'auth.forgot-password.create': 'forgot-password',
  'auth.forgot-password.store': 'forgot-password',
  'auth.reset-password.create': 'reset-password',
  'auth.reset-password.store': 'reset-password',
  'cart.show': 'cart',
  'cart.checkout': 'cart/checkout',
  'cart.items.store': 'cart/items',
  'cart.items.sync': 'cart/items/sync',
  'account.orders.index': 'account/orders',
  'account.orders.show': 'account/orders/{orderId}',
  'account.profile.edit': 'account/profile',
  'account.profile.update': 'account/profile',
  'account.wishlist': 'account/wishlist',
  'account.wishlist.toggle': 'account/wishlist/toggle',
  'about-us': 'about-us',
  contact: 'contact',
  'storage.local.upload': 'storage/{path}',
};
