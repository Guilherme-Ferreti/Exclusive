declare namespace App {
  namespace Data {
    namespace Actions {
      namespace Admin {
        export type StoreProductData = {
          name: string;
          description: string | null;
          preview_image: string | null;
          detail_image: string | null;
          current_price: number;
          category_id: string;
        };
        export type UpdateProductData = {
          name: string;
          description: string | null;
          current_price: number;
          preview_image: string;
          detail_image: string;
          category_id: string;
        };
      }
    }
    namespace Inertia {
      export type Cart = {
        subtotal: number;
        shippingCosts: number;
        total: number;
        items: App.Data.Inertia.CartItem[];
      };
      export type CartItem = {
        subtotal: number;
        id: string;
        quantity: number;
        product: App.Data.Inertia.ProductPreview;
      };
      export type Category = {
        id: string;
        name: string;
        slug: string;
      };
      export type OrderItemShowData = {
        subtotal: number;
        id: string;
        quantity: number;
        unitPrice: number;
        product: App.Data.Inertia.ProductPreview;
      };
      export type OrderPreview = {
        statusColor: App.Enums.BadgeColor;
        orderedAtDay: string;
        id: string;
        number: string;
        createdAt: string;
        total: number;
        status: App.Enums.OrderStatus;
      };
      export type OrderShowData = {
        statusColor: App.Enums.BadgeColor;
        orderedAt: string;
        id: string;
        number: string;
        createdAt: string;
        total: number;
        status: App.Enums.OrderStatus;
        items: App.Data.Inertia.OrderItemShowData[];
      };
      export type ProductPreview = {
        id: string;
        name: string;
        previewImage: string;
        detailImage: string;
        currentPrice: number;
      };
      export type ProductShow = {
        id: string;
        name: string;
        description: string | null;
        currentPrice: number;
        detailImage: string;
        category: App.Data.Inertia.Category;
      };
    }
  }
  namespace Enums {
    export type BadgeColor = 'yellow' | 'blue' | 'green';
    export type CacheKey = 'featured_categories' | 'featured_products' | 'best_selling_products';
    export type OrderStatus = 'pending' | 'shipped' | 'delivered';
    export type ToastType = 'success' | 'error' | 'warning' | 'info' | 'default';
  }
}
declare namespace Illuminate {
  export type CursorPaginator<TKey, TValue> = {
    data: TKey extends string ? Record<TKey, TValue> : TValue[];
    links: {
      url: string | null;
      label: string;
      active: boolean;
    }[];
    meta: {
      path: string;
      per_page: number;
      next_cursor: string | null;
      next_page_url: string | null;
      prev_cursor: string | null;
      prev_page_url: string | null;
    };
  };
  export type CursorPaginatorInterface<TKey, TValue> = Illuminate.CursorPaginator<TKey, TValue>;
  export type LengthAwarePaginator<TKey, TValue> = {
    data: TKey extends string ? Record<TKey, TValue> : TValue[];
    links: {
      url: string | null;
      label: string;
      active: boolean;
    }[];
    meta: {
      total: number;
      current_page: number;
      first_page_url: string;
      from: number | null;
      last_page: number;
      last_page_url: string;
      next_page_url: string | null;
      path: string;
      per_page: number;
      prev_page_url: string | null;
      to: number | null;
    };
  };
  export type LengthAwarePaginatorInterface<TKey, TValue> = Illuminate.LengthAwarePaginator<TKey, TValue>;
}
declare namespace Spatie {
  namespace LaravelData {
    export type CursorPaginatedDataCollection<TKey, TValue> = Illuminate.CursorPaginator<TKey, TValue>;
    export type PaginatedDataCollection<TKey, TValue> = Illuminate.LengthAwarePaginator<TKey, TValue>;
  }
}
