=== vuejs rules ===

# Vue.js Official Documentation

This is the official documentation repository for Vue.js 3.5, a progressive JavaScript framework for building user interfaces. Built with VitePress 1.6.4, the documentation site provides comprehensive guides, API references, and examples covering Vue 3's Composition API, Options API, reactivity system, component architecture, and TypeScript integration. The project uses Vue 3.5.12 and requires Node.js 18 or higher with pnpm 9.12.1 as the package manager. It serves as both a learning resource for developers new to Vue and a detailed reference for experienced users.

The documentation is structured into multiple sections including essential concepts (template syntax, reactivity, components), in-depth component guides (props, events, slots, provide/inject, async components), scaling-up topics (SFC, routing, state management, SSR, testing), best practices (production deployment, performance, accessibility, security), TypeScript integration guides, and complete API references. It supports 14 official language translations (Chinese Simplified, Japanese, Ukrainian, French, Korean, Portuguese, Bengali, Italian, Persian, Russian, Czech, Polish, Chinese Traditional, plus the English original), includes interactive examples via Vue Playground integration (@vue/repl 4.4.2), and features a sophisticated search powered by Algolia. The build system leverages VitePress plugins including vitepress-plugin-llms 0.0.8 for LLM-friendly documentation with customizable templates and vitepress-plugin-group-icons 1.5.4 for enhanced icon support. The site is deployed at vuejs.org with additional deployment configurations for Netlify (Node 22) and Vercel, and is maintained by the Vue core team and community contributors.

## Creating a Vue Application

Initialize and mount a Vue 3 application to the DOM.

```js
// main.js - Basic Vue app setup
import { createApp } from 'vue';
import App from './App.vue';

// Create application instance
const app = createApp(App);

// Mount to DOM element
app.mount('#app');

// Register global components before mounting
app.component('GlobalButton', {
  template: '<button><slot /></button>',
});

// Register global directives
app.directive('focus', {
  mounted(el) {
    el.focus();
  },
});

// Provide global data
app.provide('apiUrl', 'https://api.example.com');

// Configure app properties
app.config.errorHandler = (err) => {
  console.error('App error:', err);
};

app.mount('#app');
```

## Reactive State with ref()

Create reactive primitive values that automatically update the UI.

```js
// Counter.vue - Simple reactive counter component
<script setup>
import { ref } from 'vue'

// Create reactive reference
const count = ref(0)
const message = ref('Hello Vue!')

// Functions that modify reactive state
function increment() {
  count.value++  // Access via .value in JS
}

function reset() {
  count.value = 0
  message.value = 'Reset!'
}

// Computed value based on reactive state
import { computed } from 'vue'
const doubleCount = computed(() => count.value * 2)
</script>

<template>
  <!-- Refs auto-unwrap in templates -->
  <div>
    <p>{{ message }}</p>
    <p>Count: {{ count }}</p>
    <p>Double: {{ doubleCount }}</p>
    <button @click="increment">Increment</button>
    <button @click="reset">Reset</button>
  </div>
</template>
```

## Reactive Objects with reactive()

Create deeply reactive object proxies for complex state.

```js
// UserProfile.vue - Managing reactive object state
<script setup>
import { reactive, toRefs } from 'vue'

// Create reactive object
const state = reactive({
  user: {
    name: 'John Doe',
    email: 'john@example.com',
    preferences: {
      theme: 'dark',
      notifications: true
    }
  },
  loading: false,
  error: null
})

// Nested properties are automatically reactive
function updateTheme(newTheme) {
  state.user.preferences.theme = newTheme
}

// Update entire nested object
function updateUser(userData) {
  Object.assign(state.user, userData)
}

// Destructure with reactivity preservation
const { user, loading } = toRefs(state)
</script>

<template>
  <div v-if="!loading">
    <h2>{{ state.user.name }}</h2>
    <p>{{ state.user.email }}</p>
    <p>Theme: {{ state.user.preferences.theme }}</p>
    <button @click="updateTheme('light')">Light Mode</button>
  </div>
</template>
```

## Computed Properties

Define cached derived state that updates when dependencies change.

```js
// ShoppingCart.vue - Computed properties for cart calculations
<script setup>
import { ref, computed } from 'vue'

const items = ref([
  { id: 1, name: 'Laptop', price: 999, quantity: 1 },
  { id: 2, name: 'Mouse', price: 29, quantity: 2 },
  { id: 3, name: 'Keyboard', price: 79, quantity: 1 }
])

// Read-only computed
const totalItems = computed(() => {
  return items.value.reduce((sum, item) => sum + item.quantity, 0)
})

const subtotal = computed(() => {
  return items.value.reduce((sum, item) =>
    sum + (item.price * item.quantity), 0
  )
})

const tax = computed(() => subtotal.value * 0.1)
const total = computed(() => subtotal.value + tax.value)

// Writable computed
const discountCode = ref('')
const finalTotal = computed({
  get() {
    return discountCode.value === 'SAVE10'
      ? total.value * 0.9
      : total.value
  },
  set(value) {
    // Custom setter logic
    console.log('Setting total:', value)
  }
})
</script>

<template>
  <div>
    <p>Items: {{ totalItems }}</p>
    <p>Subtotal: ${{ subtotal.toFixed(2) }}</p>
    <p>Tax: ${{ tax.toFixed(2) }}</p>
    <p>Total: ${{ total.toFixed(2) }}</p>
    <input v-model="discountCode" placeholder="Discount code">
    <p>Final: ${{ finalTotal.toFixed(2) }}</p>
  </div>
</template>
```

## Component Props

Pass data from parent to child components with type validation.

```js
// BlogPost.vue - Props with validation
<script setup>
import { computed } from 'vue'

// Define props with types and defaults
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  content: {
    type: String,
    default: ''
  },
  author: {
    type: Object,
    default: () => ({ name: 'Anonymous' })
  },
  tags: {
    type: Array,
    default: () => []
  },
  likes: {
    type: Number,
    default: 0,
    validator: (value) => value >= 0
  },
  published: {
    type: Boolean,
    default: false
  }
})

// Use props in computed
const isPopular = computed(() => props.likes > 100)
const excerpt = computed(() =>
  props.content.slice(0, 150) + '...'
)
</script>

<template>
  <article>
    <h2>{{ title }}</h2>
    <p class="author">By {{ author.name }}</p>
    <p>{{ excerpt }}</p>
    <div class="tags">
      <span v-for="tag in tags" :key="tag">{{ tag }}</span>
    </div>
    <p>Likes: {{ likes }} <span v-if="isPopular">🔥</span></p>
  </article>
</template>

<!-- Parent component usage -->
<BlogPost
  title="Getting Started with Vue 3"
  :content="articleContent"
  :author="{ name: 'Jane Smith' }"
  :tags="['vue', 'javascript', 'tutorial']"
  :likes="150"
  :published="true"
/>
```

## Component Events

Emit custom events from child to parent components.

```js
// CustomInput.vue - Emitting events
<script setup>
import { ref } from 'vue'

// Declare emitted events with validation
const emit = defineEmits({
  // No validation
  change: null,

  // With validation
  update: (value) => {
    if (typeof value !== 'string') {
      console.warn('update event payload must be string')
      return false
    }
    return true
  },

  // Multiple parameters
  submit: (value, isValid) => {
    return typeof value === 'string' && typeof isValid === 'boolean'
  }
})

const inputValue = ref('')

function handleInput(event) {
  inputValue.value = event.target.value
  emit('update', inputValue.value)
}

function handleSubmit() {
  const isValid = inputValue.value.length > 0
  emit('submit', inputValue.value, isValid)
}

function handleChange() {
  emit('change')
}
</script>

<template>
  <div>
    <input
      :value="inputValue"
      @input="handleInput"
      @change="handleChange"
    />
    <button @click="handleSubmit">Submit</button>
  </div>
</template>

<!-- Parent component usage -->
<script setup>
function handleUpdate(value) {
  console.log('Input updated:', value)
}

function handleSubmit(value, isValid) {
  if (isValid) {
    console.log('Form submitted:', value)
  }
}
</script>

<template>
  <CustomInput
    @update="handleUpdate"
    @submit="handleSubmit"
    @change="() => console.log('changed')"
  />
</template>
```

## v-model Component Binding

Create two-way data binding between parent and child components.

```js
// RatingInput.vue - Custom v-model implementation
<script setup>
import { computed } from 'vue'

// v-model uses 'modelValue' prop and 'update:modelValue' event
const props = defineProps({
  modelValue: {
    type: Number,
    default: 0
  },
  max: {
    type: Number,
    default: 5
  }
})

const emit = defineEmits(['update:modelValue'])

// Computed with getter/setter for v-model
const rating = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

function setRating(value) {
  rating.value = value
}
</script>

<template>
  <div class="rating">
    <button
      v-for="n in max"
      :key="n"
      :class="{ active: n <= rating }"
      @click="setRating(n)"
    >
      ⭐
    </button>
  </div>
</template>

<!-- Parent component usage -->
<script setup>
import { ref } from 'vue'

const userRating = ref(3)
</script>

<template>
  <div>
    <RatingInput v-model="userRating" :max="5" />
    <p>Your rating: {{ userRating }}</p>
  </div>
</template>

<!-- Multiple v-model bindings -->
<script setup>
// AdvancedForm.vue
const props = defineProps(['firstName', 'lastName'])
const emit = defineEmits(['update:firstName', 'update:lastName'])
</script>

<template>
  <input
    :value="firstName"
    @input="$emit('update:firstName', $event.target.value)"
  />
  <input
    :value="lastName"
    @input="$emit('update:lastName', $event.target.value)"
  />
</template>

<!-- Parent usage with multiple v-models -->
<AdvancedForm
  v-model:first-name="user.first"
  v-model:last-name="user.last"
/>
```

## Watchers

React to reactive state changes with side effects.

```js
// SearchComponent.vue - Using watchers
<script setup>
import { ref, watch, watchEffect } from 'vue'

const searchQuery = ref('')
const searchResults = ref([])
const loading = ref(false)
const error = ref(null)

// Basic watcher
watch(searchQuery, (newQuery, oldQuery) => {
  console.log(`Query changed from "${oldQuery}" to "${newQuery}"`)
})

// Watcher with options
watch(
  searchQuery,
  async (newQuery) => {
    if (newQuery.length < 3) {
      searchResults.value = []
      return
    }

    loading.value = true
    error.value = null

    try {
      const response = await fetch(`/api/search?q=${newQuery}`)
      searchResults.value = await response.json()
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }
  },
  {
    debounce: 300,  // Wait 300ms after last change
    immediate: false  // Don't run on mount
  }
)

// Watch multiple sources
const firstName = ref('')
const lastName = ref('')

watch(
  [firstName, lastName],
  ([newFirst, newLast], [oldFirst, oldLast]) => {
    console.log('Name changed:', newFirst, newLast)
  }
)

// Watch reactive object
const user = ref({ name: 'John', age: 30 })

watch(
  () => user.value.age,
  (newAge) => {
    console.log('Age changed to:', newAge)
  }
)

// Deep watcher for nested objects
const state = ref({
  user: { profile: { name: 'John' } }
})

watch(state, (newState) => {
  console.log('Deep change detected')
}, { deep: true })

// watchEffect - automatically tracks dependencies
watchEffect(() => {
  // Automatically re-runs when any reactive dependency changes
  console.log(`Searching for: ${searchQuery.value}`)
  document.title = `Search: ${searchQuery.value}`
})

// Cleanup with watchEffect
const stopWatcher = watchEffect((onCleanup) => {
  const timer = setTimeout(() => {
    console.log('Delayed effect')
  }, 1000)

  onCleanup(() => {
    clearTimeout(timer)
  })
})

// Manually stop watcher
// stopWatcher()
</script>

<template>
  <input v-model="searchQuery" placeholder="Search...">
  <div v-if="loading">Loading...</div>
  <div v-else-if="error">Error: {{ error }}</div>
  <ul v-else>
    <li v-for="result in searchResults" :key="result.id">
      {{ result.title }}
    </li>
  </ul>
</template>
```

## Lifecycle Hooks

Execute code at specific stages of component lifecycle.

```js
// DataFetcher.vue - Lifecycle hooks usage
<script setup>
import {
  ref,
  onMounted,
  onUpdated,
  onUnmounted,
  onBeforeMount,
  onBeforeUpdate,
  onBeforeUnmount,
  onErrorCaptured
} from 'vue'

const data = ref(null)
const updateCount = ref(0)
let intervalId = null

// Before component is mounted to DOM
onBeforeMount(() => {
  console.log('Component is about to be mounted')
})

// After component is mounted to DOM
onMounted(async () => {
  console.log('Component mounted, DOM is ready')

  // Fetch initial data
  try {
    const response = await fetch('/api/data')
    data.value = await response.json()
  } catch (error) {
    console.error('Failed to fetch data:', error)
  }

  // Set up polling
  intervalId = setInterval(() => {
    console.log('Polling data...')
  }, 5000)

  // Access DOM elements
  const element = document.getElementById('my-element')
  if (element) {
    element.focus()
  }
})

// Before component updates
onBeforeUpdate(() => {
  console.log('Component is about to update')
})

// After component updates
onUpdated(() => {
  updateCount.value++
  console.log('Component updated, count:', updateCount.value)
})

// Before component unmounts
onBeforeUnmount(() => {
  console.log('Component is about to unmount')
})

// Cleanup when component unmounts
onUnmounted(() => {
  console.log('Component unmounted')

  // Clear intervals/timers
  if (intervalId) {
    clearInterval(intervalId)
  }

  // Remove event listeners
  window.removeEventListener('resize', handleResize)

  // Clean up subscriptions
  // unsubscribe()
})

// Error handling
onErrorCaptured((err, instance, info) => {
  console.error('Error captured:', err, info)
  // Return false to prevent error propagation
  return false
})

function handleResize() {
  console.log('Window resized')
}

// Register event listener
onMounted(() => {
  window.addEventListener('resize', handleResize)
})
</script>

<template>
  <div id="my-element">
    <div v-if="data">{{ data.title }}</div>
    <div v-else>Loading...</div>
  </div>
</template>
```

## Provide/Inject Dependency Injection

Share data across component tree without prop drilling.

```js
// App.vue - Root component providing data
<script setup>
import { provide, ref, readonly } from 'vue'

// Provide reactive data
const theme = ref('dark')
const user = ref({
  id: 1,
  name: 'John Doe',
  role: 'admin'
})

// Provide with read-only wrapper
provide('theme', readonly(theme))

// Provide with methods to modify
provide('user', {
  data: readonly(user),
  updateName: (newName) => {
    user.value.name = newName
  },
  logout: () => {
    user.value = null
  }
})

// Provide non-reactive values
provide('apiUrl', 'https://api.example.com')
provide('config', {
  maxItems: 100,
  pageSize: 20
})

// Provide with Symbol keys (recommended for plugins)
import { InjectionKey } from 'vue'
const userKey = Symbol('user')
provide(userKey, user)
</script>

<template>
  <ChildComponent />
</template>

// ChildComponent.vue - Deep nested component consuming data
<script setup>
import { inject } from 'vue'

// Inject with default value
const theme = inject('theme', 'light')

// Inject object with methods
const userContext = inject('user')
const apiUrl = inject('apiUrl')

// Inject with type safety
const config = inject('config')

// Handle missing injection
const optionalData = inject('optional', null)
if (!optionalData) {
  console.warn('Optional data not provided')
}

// Use injected data and methods
function changeName() {
  userContext.updateName('Jane Doe')
}

function handleLogout() {
  userContext.logout()
}
</script>

<template>
  <div :class="theme">
    <p v-if="userContext.data">
      Hello, {{ userContext.data.name }}
    </p>
    <button @click="changeName">Change Name</button>
    <button @click="handleLogout">Logout</button>
  </div>
</template>

// Plugin example with provide/inject
// plugins/api.js
export default {
  install(app, options) {
    const apiClient = {
      baseUrl: options.baseUrl,
      async get(endpoint) {
        const response = await fetch(`${this.baseUrl}${endpoint}`)
        return response.json()
      },
      async post(endpoint, data) {
        const response = await fetch(`${this.baseUrl}${endpoint}`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        })
        return response.json()
      }
    }

    app.provide('api', apiClient)
  }
}

// main.js
import apiPlugin from './plugins/api'
app.use(apiPlugin, { baseUrl: 'https://api.example.com' })

// Component using plugin
const api = inject('api')
const data = await api.get('/users')
```

## Composables

Extract and reuse stateful logic across components.

```js
// composables/useFetch.js - Reusable fetch logic
import { ref, watch, toValue } from 'vue'

export function useFetch(url) {
  const data = ref(null)
  const error = ref(null)
  const loading = ref(false)

  async function fetchData() {
    loading.value = true
    error.value = null
    data.value = null

    try {
      // toValue() unwraps refs, getters, and returns plain values as-is
      const response = await fetch(toValue(url))
      if (!response.ok) throw new Error(response.statusText)
      data.value = await response.json()
    } catch (err) {
      error.value = err
    } finally {
      loading.value = false
    }
  }

  // Re-fetch when URL changes
  watch(() => toValue(url), fetchData, { immediate: true })

  return { data, error, loading, refetch: fetchData }
}

// composables/useMouse.js - Track mouse position
import { ref, onMounted, onUnmounted } from 'vue'

export function useMouse() {
  const x = ref(0)
  const y = ref(0)

  function update(event) {
    x.value = event.pageX
    y.value = event.pageY
  }

  onMounted(() => window.addEventListener('mousemove', update))
  onUnmounted(() => window.removeEventListener('mousemove', update))

  return { x, y }
}

// composables/useLocalStorage.js - Persistent state
import { ref, watch } from 'vue'

export function useLocalStorage(key, defaultValue) {
  const storedValue = localStorage.getItem(key)
  const value = ref(storedValue ? JSON.parse(storedValue) : defaultValue)

  watch(
    value,
    (newValue) => {
      localStorage.setItem(key, JSON.stringify(newValue))
    },
    { deep: true }
  )

  function remove() {
    localStorage.removeItem(key)
    value.value = defaultValue
  }

  return { value, remove }
}

// Component.vue - Using composables
<script setup>
import { ref, computed } from 'vue'
import { useFetch } from './composables/useFetch'
import { useMouse } from './composables/useMouse'
import { useLocalStorage } from './composables/useLocalStorage'

// Use fetch composable with reactive URL
const userId = ref(1)
const url = computed(() => `/api/users/${userId.value}`)
const { data: user, error, loading, refetch } = useFetch(url)

// Use mouse tracking
const { x, y } = useMouse()

// Use persistent storage
const { value: settings, remove: clearSettings } = useLocalStorage('app-settings', {
  theme: 'dark',
  language: 'en'
})

function updateTheme(newTheme) {
  settings.value.theme = newTheme
}
</script>

<template>
  <div>
    <!-- Mouse position -->
    <p>Mouse: {{ x }}, {{ y }}</p>

    <!-- User data -->
    <div v-if="loading">Loading user...</div>
    <div v-else-if="error">Error: {{ error.message }}</div>
    <div v-else-if="user">
      <h2>{{ user.name }}</h2>
      <button @click="refetch">Refresh</button>
    </div>

    <!-- Settings -->
    <p>Theme: {{ settings.theme }}</p>
    <button @click="updateTheme('light')">Light Mode</button>
    <button @click="clearSettings">Reset Settings</button>
  </div>
</template>
```

## Template Directives

Use built-in directives for declarative DOM manipulation.

```vue
<!-- Conditional rendering -->
<div v-if="type === 'A'">Type A</div>
<div v-else-if="type === 'B'">Type B</div>
<div v-else>Not A or B</div>

<!-- Show/hide with CSS -->
<div v-show="isVisible">Toggle visibility</div>

<!-- List rendering -->
<ul>
  <li v-for="(item, index) in items" :key="item.id">
    {{ index }}: {{ item.name }}
  </li>
</ul>

<!-- Iterate over object -->
<ul>
  <li v-for="(value, key, index) in object" :key="key">
    {{ index }}. {{ key }}: {{ value }}
  </li>
</ul>

<!-- Event handling -->
<button @click="handleClick">Click me</button>
<button @click="count++">Increment</button>
<button @click.prevent="submit">Submit</button>
<button @click.stop="handleClick">Stop propagation</button>
<input @keyup.enter="submit" />
```

## Async Components

Lazy load components for code splitting and performance.

```js
// Router.vue - Async component loading
<script setup>
import { ref, defineAsyncComponent } from 'vue'

// Basic async component
const AsyncModal = defineAsyncComponent(() =>
  import('./components/Modal.vue')
)

// With loading and error states
const AsyncChart = defineAsyncComponent({
  loader: () => import('./components/Chart.vue'),

  loadingComponent: {
    template: '<div>Loading chart...</div>'
  },

  errorComponent: {
    template: '<div>Failed to load chart</div>'
  },

  delay: 200,  // Delay before showing loading component
  timeout: 3000  // Timeout for loading
})

// Conditional async loading
const showHeavyComponent = ref(false)
const HeavyComponent = defineAsyncComponent(() =>
  import('./components/HeavyComponent.vue')
)

// Suspense wrapper for async components
import { Suspense } from 'vue'
</script>

<template>
  <!-- Simple async component -->
  <AsyncModal v-if="showModal" />

  <!-- Async with error handling -->
  <AsyncChart :data="chartData" />

  <!-- With Suspense -->
  <Suspense>
    <!-- Component with async setup() -->
    <template #default>
      <AsyncDashboard />
    </template>

    <!-- Loading state -->
    <template #fallback>
      <div>Loading dashboard...</div>
    </template>
  </Suspense>

  <!-- Conditional loading -->
  <button @click="showHeavyComponent = true">
    Load Heavy Component
  </button>
  <HeavyComponent v-if="showHeavyComponent" />
</template>

// AsyncDashboard.vue - Component with async setup
<script setup>
const data = await fetch('/api/dashboard').then(r => r.json())
// Top-level await is supported in Suspense
</script>

<template>
  <div>{{ data.title }}</div>
</template>
```

## VitePress Configuration

Configure documentation site build and deployment settings.

```ts
// .vitepress/config.ts - VitePress configuration
import { defineConfigWithTheme, type Plugin } from 'vitepress'
import type { Config as ThemeConfig } from '@vue/theme'
import llmstxt from 'vitepress-plugin-llms'
import { groupIconMdPlugin, groupIconVitePlugin } from 'vitepress-plugin-group-icons'
import baseConfig from '@vue/theme/config'

export default defineConfigWithTheme<ThemeConfig>({
  extends: baseConfig,

  // Site metadata
  lang: 'en-US',
  title: 'Vue.js',
  description: 'Vue.js - The Progressive JavaScript Framework',

  // Source directory
  srcDir: 'src',
  srcExclude: ['tutorial/**/description.md'],

  // Site URL for sitemap
  sitemap: {
    hostname: 'https://vuejs.org'
  },

  // HTML head tags
  head: [
    ['meta', { name: 'theme-color', content: '#3c8772' }],
    ['meta', { property: 'og:type', content: 'website' }],
    ['meta', { property: 'og:url', content: 'https://vuejs.org/' }],
    ['link', { rel: 'icon', href: '/logo.svg' }],
    // Analytics and scripts
    ['script', { src: 'https://cdn.usefathom.com/script.js', 'data-site': 'XNOLWPLB', 'data-spa': 'auto', defer: '' }]
  ],

  // Theme configuration
  themeConfig: {
    // Navigation menu
    nav: [
      {
        text: 'Docs',
        activeMatch: `^/(guide|style-guide|cookbook|examples)/`,
        items: [
          { text: 'Guide', link: '/guide/introduction' },
          { text: 'Tutorial', link: '/tutorial/' },
          { text: 'Examples', link: '/examples/' },
          { text: 'Quick Start', link: '/guide/quick-start' },
          { text: 'Glossary', link: '/glossary/' },
          { text: 'Error Reference', link: '/error-reference/' }
        ]
      },
      {
        text: 'API',
        activeMatch: `^/api/`,
        link: '/api/'
      },
      {
        text: 'Playground',
        link: 'https://play.vuejs.org'
      }
    ],

    // Sidebar navigation
    sidebar: {
      '/guide/': [
        {
          text: 'Getting Started',
          items: [
            { text: 'Introduction', link: '/guide/introduction' },
            { text: 'Quick Start', link: '/guide/quick-start' }
          ]
        },
        {
          text: 'Essentials',
          items: [
            { text: 'Creating an Application', link: '/guide/essentials/application' },
            { text: 'Template Syntax', link: '/guide/essentials/template-syntax' },
            { text: 'Reactivity Fundamentals', link: '/guide/essentials/reactivity-fundamentals' },
            { text: 'Computed Properties', link: '/guide/essentials/computed' },
            { text: 'Watchers', link: '/guide/essentials/watchers' },
            { text: 'Lifecycle Hooks', link: '/guide/essentials/lifecycle' }
          ]
        }
      ]
    },

    // Search with Algolia
    algolia: {
      indexName: 'vuejs',
      appId: 'ML0LEBN7FQ',
      apiKey: '10e7a8b13e6aec4007343338ab134e05',
      searchParameters: {
        facetFilters: ['version:v3']
      }
    },

    // Social links
    carbonAds: {
      code: 'CEBDT27Y',
      placement: 'vuejsorg'
    },

    socialLinks: [
      { icon: 'github', link: 'https://github.com/vuejs/' },
      { icon: 'twitter', link: 'https://x.com/vuejs' },
      { icon: 'discord', link: 'https://discord.com/invite/vue' }
    ],

    // Edit link
    editLink: {
      repo: 'vuejs/docs',
      text: 'Edit this page on GitHub'
    },

    // Footer
    footer: {
      license: {
        text: 'MIT License',
        link: 'https://opensource.org/licenses/MIT'
      },
      copyright: `Copyright © 2014-${new Date().getFullYear()} Evan You`
    }
  },

  // Markdown configuration
  markdown: {
    theme: 'github-dark',
    config(md) {
      md.use(headerPlugin).use(groupIconMdPlugin)
    }
  },

  // Vite configuration
  vite: {
    define: {
      __VUE_OPTIONS_API__: false
    },
    optimizeDeps: {
      include: ['gsap', 'dynamics.js'],
      exclude: ['@vue/repl']
    },
    ssr: {
      external: ['@vue/repl']
    },
    server: {
      host: true,
      fs: {
        allow: ['../..']
      }
    },
    build: {
      chunkSizeWarningLimit: Infinity
    },
    json: {
      stringify: true
    },
    // VitePress plugins for enhanced functionality
    plugins: [
      llmstxt({
        ignoreFiles: [
          'about/team/**/*',
          'about/team.md',
          'about/privacy.md',
          'about/coc.md',
          'developers/**/*',
          'ecosystem/themes.md',
          'examples/**/*',
          'partners/**/*',
          'sponsor/**/*',
          'index.md'
        ],
        customLLMsTxtTemplate: `\
# Vue.js

Vue.js - The Progressive JavaScript Framework

## Table of Contents

{toc}`
      }) as Plugin,
      groupIconVitePlugin({
        customIcon: {
          cypress: 'vscode-icons:file-type-cypress',
          'testing library': 'logos:testing-library'
        }
      }) as Plugin
    ]
  }
})
```

## Building and Development

Build and serve the documentation site locally or in production.

```bash
# Install dependencies with pnpm (required)
pnpm install

# Start development server with hot reload
pnpm run dev
# Starts at http://localhost:5173

# Build for production
pnpm run build
# Outputs to .vitepress/dist

# Preview production build locally
pnpm run preview

# Type checking with TypeScript compiler (vue-tsc)
pnpm run type

# Enable corepack for pnpm (required for Node.js 18+)
corepack enable

# Requirements
# - Node.js 18.0.0 or higher (Node 22 recommended for production)
# - pnpm 9.12.1 (managed via packageManager field)
# - The preinstall script ensures only pnpm is used (npx only-allow pnpm)
```

**Deployment Configuration:**

```toml
# netlify.toml - Netlify deployment
[build.environment]
  NODE_VERSION = "22"

[build]
  publish = ".vitepress/dist"
  command = "pnpm run build"
```

```json
// vercel.json - Vercel deployment with cache headers
{
  "$schema": "https://openapi.vercel.sh/vercel.json",
  "headers": [
    {
      "source": "/assets/(.*)",
      "headers": [
        {
          "key": "Cache-Control",
          "value": "max-age=31536000, immutable"
        }
      ]
    }
  ],
  "rewrites": [
    {
      "source": "/:path*",
      "destination": "/:path*.html"
    }
  ]
}
```

## Summary and Integration Patterns

The Vue.js 3.5 documentation showcases comprehensive implementation patterns for building modern web applications with the latest Vue 3 features. The repository demonstrates the Composition API as the primary approach with `<script setup>` syntax for concise component authoring, while maintaining Options API documentation for compatibility. Key patterns include reactive state management with `ref()` and `reactive()`, computed properties for derived state, watchers for side effects, and component communication through props, events, and provide/inject. The documentation emphasizes TypeScript integration (with vue-tsc 2.1.6 and TypeScript 5.6.3), composables for logic reuse, lifecycle hooks for component lifecycle management, and modern features like async components with Suspense. The project structure follows VitePress best practices with content organized in the `src/` directory across guide, api, examples, tutorial, ecosystem, about, error-reference, glossary, style-guide, and translations sections.

Integration patterns include building applications from single-page apps to server-side rendered sites, with guides covering routing (Vue Router), state management (Pinia), testing strategies (with support for various testing frameworks), production deployment, performance optimization, accessibility, and security best practices. The VitePress 1.6.4-based documentation system itself serves as a reference implementation, showing how to structure large-scale documentation projects with proper code splitting via async components, performance optimization techniques, and internationalization support for 14 official language translations (Chinese Simplified, Japanese, Ukrainian, French, Korean, Portuguese, Bengali, Italian, Persian, Russian, Czech, Polish, and Chinese Traditional). The build system leverages Vite with modern plugins including vitepress-plugin-llms 0.0.8 for LLM-friendly documentation output with customizable templates and vitepress-plugin-group-icons 1.5.4 for enhanced visual presentation with custom icons. Dependencies include @vue/repl 4.4.2 for interactive playground integration, @vue/theme 2.3.0 for consistent styling across Vue ecosystem docs, and animation libraries (gsap 3.12.5, dynamics.js 1.1.5) for interactive examples. The documentation supports multiple learning paths (tutorials, examples, guided learning, style guide, glossary) and comprehensive API references organized by Global API, Composition API, Options API, Built-ins, Single-File Component syntax, and Advanced APIs. Additional features include Carbon Ads integration, Algolia-powered search with faceted filtering for v3 content, comprehensive error reference section, and extensive social/community links. Deployment is optimized for modern hosting platforms (Netlify with Node 22, Vercel with immutable cache headers for assets) with production builds outputting to `.vitepress/dist`.
