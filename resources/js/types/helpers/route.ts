type RouteParameters = {
  'account.auth.sign-up.create': never;
  'account.auth.sign-up.store': never;
  'account.auth.login.create': never;
  'account.auth.login.store': never;
  'account.auth.login.destroy': never;
  'account.auth.forgot-password.create': never;
  'account.auth.forgot-password.store': never;
  'account.auth.reset-password.create': never;
  'account.auth.reset-password.store': never;
  'account.profile.edit': never;
  'account.profile.update': never;
  'account.orders.index': never;
  'account.orders.show': {
    orderId: string | number;
  };
  'account.wishlist': never;
  'account.wishlist.toggle': {
    product: string | number;
  };
  'storefront.home': never;
  'storefront.about-us': never;
  'storefront.contact': never;
  'storefront.products.index': never;
  'storefront.products.show': {
    product: string | number;
  };
  'storefront.cart.edit': never;
  'storefront.cart.update': never;
  'storefront.cart.checkout': never;
  'storefront.cart.items.store': never;
  'storefront.cart.items.sync': never;
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
  'account.auth.sign-up.create': 'account/sign-up',
  'account.auth.sign-up.store': 'account/sign-up',
  'account.auth.login.create': 'account/login',
  'account.auth.login.store': 'account/login',
  'account.auth.login.destroy': 'account/login',
  'account.auth.forgot-password.create': 'account/forgot-password',
  'account.auth.forgot-password.store': 'account/forgot-password',
  'account.auth.reset-password.create': 'account/reset-password',
  'account.auth.reset-password.store': 'account/reset-password',
  'account.profile.edit': 'account/profile',
  'account.profile.update': 'account/profile',
  'account.orders.index': 'account/orders',
  'account.orders.show': 'account/orders/{orderId}',
  'account.wishlist': 'account/wishlist',
  'account.wishlist.toggle': 'account/wishlist/{product}/toggle',
  'storefront.home': '/',
  'storefront.about-us': 'about-us',
  'storefront.contact': 'contact',
  'storefront.products.index': 'products',
  'storefront.products.show': 'products/{product}',
  'storefront.cart.edit': 'cart',
  'storefront.cart.update': 'cart',
  'storefront.cart.checkout': 'cart/checkout',
  'storefront.cart.items.store': 'cart/items',
  'storefront.cart.items.sync': 'cart/items/sync',
  'storage.local.upload': 'storage/{path}',
};
