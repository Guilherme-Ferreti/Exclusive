declare namespace App.Data.Inertia {
  export type Category = {
    id: string;
    name: string;
    slug: string;
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
