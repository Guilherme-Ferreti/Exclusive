export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  auth: Auth;
};

export interface Auth {
  isGuest: boolean;
  isAuthenticated: boolean;
  user: User;
  wishlist: string[];
}

export interface User {
  id: number;
  name: string;
  email: string;
}

export interface Category {
  id: string;
  name: string;
  slug: string;
}

export interface ProductPreview {
  id: string;
  name: string;
  preview_image: string;
  current_price: number;
}
