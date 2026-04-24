import { AppPageProps } from '@/types/index';
import { TYPE } from 'vue-toastification';
import { route as routeFn } from 'ziggy-js';

// Extend ImportMeta interface for Vite...
declare module 'vite/client' {
  interface ImportMetaEnv {
    readonly VITE_APP_NAME: string;
    [key: string]: string | boolean | undefined;
  }

  interface ImportMeta {
    readonly env: ImportMetaEnv;
    readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
  }
}

declare module '@inertiajs/core' {
  interface InertiaConfig {
    flashDataType: {
      toast?: { type: TYPE; message: string };
    };
  }

  interface PageProps extends InertiaPageProps, AppPageProps {}
}

declare global {
  var route: typeof routeFn;
}

declare module 'vue' {
  interface ComponentCustomProperties {
    $inertia: typeof Router;
    $page: Page;
    $headManager: ReturnType<typeof createHeadManager>;
    route: typeof routeFn;
  }
}

declare module 'ziggy-js' {
  interface TypeConfig {
    strictRouteNames: true;
  }
}
