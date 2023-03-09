const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
    devServer: {
        proxy: {
            '^/api': {
                target: process.env.VITE_API_HOST,
                ws: true,
                changeOrigin: true
            }
        }
    }
})
