# instalacion de pinia

|dependencias de tailwind|
|-|
|<pre><code class="bash">npm install pinia
</code></pre>|
|<pre><code class="bash">npm install pinia-plugin-persistedstate
</code></pre>|

# estructura de codigo en pinia

colocar pinia en main.js y usarlo

```javascript
import { createPinia } from 'pinia';
app.use(router).use(pinia);
```