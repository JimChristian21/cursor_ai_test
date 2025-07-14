# Troubleshooting Guide

## ❌ "crypto hash is not a function" Error

This error is common with Node.js v16+ due to changes in the crypto module. Here are several solutions:

### ✅ Solution 1: Updated Configuration (Applied)

The Vite configuration has been updated with Node.js polyfills. Try:
```bash
rm -rf node_modules/.vite
npm run build
php artisan serve
```

### ✅ Solution 2: Use Node.js LTS Version

If the polyfills don't work, try using Node.js LTS (v18 or v20):

**Using NVM (Recommended):**
```bash
# Install NVM if you don't have it
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

# Restart terminal or run:
source ~/.bashrc

# Install and use Node.js LTS
nvm install --lts
nvm use --lts

# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install
npm run build
```

**Using Direct Download:**
- Download Node.js LTS from [nodejs.org](https://nodejs.org/)
- Install and restart terminal
- Run: `rm -rf node_modules package-lock.json && npm install`

### ✅ Solution 3: Alternative Vite Configuration

If still having issues, replace `vite.config.js` with this simpler version:

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
```

### ✅ Solution 4: Development Mode Only

For development, you can run without building:
```bash
# Terminal 1
php artisan serve

# Terminal 2  
npm run dev
```

### ✅ Solution 5: Legacy Node.js Options

Add to your `.bashrc` or `.zshrc`:
```bash
export NODE_OPTIONS="--openssl-legacy-provider"
```

Then restart terminal and run:
```bash
npm run build
```

## 🔧 Other Common Issues

### Laravel Server Issues

**Port already in use:**
```bash
# Find and kill process using port 8000
lsof -ti:8000 | xargs kill -9
php artisan serve
```

**Database connection errors:**
```bash
# Recreate SQLite database
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate:fresh --seed
```

**Permission errors:**
```bash
chmod -R 775 storage bootstrap/cache
```

### NPM/Node Issues

**Clear all caches:**
```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

**Dependency conflicts:**
```bash
npm install --legacy-peer-deps
```

### Vue/Inertia Issues

**Inertia not loading:**
- Check browser console for errors
- Ensure `@inertiaHead` is in your Blade template
- Verify middleware is registered

**Vue components not rendering:**
- Check file paths in `app.js`
- Ensure `.vue` files are in `resources/js/Pages/`

## 📞 Getting Help

If none of these solutions work:

1. **Check Node.js version:** `node --version`
2. **Check logs:** `tail -f storage/logs/laravel.log`
3. **Browser console:** Open DevTools and check for errors
4. **Verify setup:** Run `php artisan route:list` to see routes

## 🚀 Quick Recovery Commands

```bash
# Complete reset
rm -rf node_modules package-lock.json
npm install
rm -rf public/build
npm run build
php artisan serve
```

---

💡 **Tip:** The most common fix is using Node.js LTS version (18 or 20) instead of the latest version.