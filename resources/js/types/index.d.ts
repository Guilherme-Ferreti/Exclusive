export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  auth: Auth;
};

export interface Auth {
  isGuest: boolean;
  isAuthenticated: boolean;
  user: User;
  wishlist: string[];
  cartItems: {
    productId: string;
    quantity: number;
  }[];
}

export interface User {
  id: number;
  name: string;
  email: string;
}

export interface PaginatedResults<T> {
  data: T[];
  links: {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
  };
  meta: {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
  };
}
