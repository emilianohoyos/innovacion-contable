// vite.config.js
import { defineConfig } from "file:///D:/udemy/innovacion-contable/dashboard/node_modules/vite/dist/node/index.js";
import laravel from "file:///D:/udemy/innovacion-contable/dashboard/node_modules/laravel-vite-plugin/dist/index.js";
import { viteStaticCopy } from "file:///D:/udemy/innovacion-contable/dashboard/node_modules/vite-plugin-static-copy/dist/index.js";
var vite_config_default = defineConfig({
  build: {
    manifest: true,
    outDir: "public/build/",
    cssCodeSplit: true
  },
  plugins: [
    laravel([
      "resources/css/main.css",
      "resources/js/main.js",
      "resources/js/apply_document_type/apply_document_type.js",
      "resources/js/applytype/applytype.js",
      "resources/js/employees/employees.js",
      "resources/js/folders/folder.js"
      // Update the entry module here
    ]),
    viteStaticCopy({
      targets: [
        {
          src: "resources/css",
          dest: ""
        },
        {
          src: "resources/fonts",
          dest: ""
        },
        {
          src: "resources/images",
          dest: ""
        },
        {
          src: "resources/js",
          dest: ""
        },
        {
          src: "resources/maps",
          dest: ""
        },
        {
          src: "resources/scss",
          dest: ""
        },
        {
          src: "resources/plugins",
          dest: ""
        },
        {
          src: "resources/sass",
          dest: ""
        }
      ]
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFx1ZGVteVxcXFxpbm5vdmFjaW9uLWNvbnRhYmxlXFxcXGRhc2hib2FyZFwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiRDpcXFxcdWRlbXlcXFxcaW5ub3ZhY2lvbi1jb250YWJsZVxcXFxkYXNoYm9hcmRcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0Q6L3VkZW15L2lubm92YWNpb24tY29udGFibGUvZGFzaGJvYXJkL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB7IHZpdGVTdGF0aWNDb3B5IH0gZnJvbSAndml0ZS1wbHVnaW4tc3RhdGljLWNvcHknXG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgYnVpbGQ6IHtcbiAgICAgICAgbWFuaWZlc3Q6IHRydWUsXG4gICAgICAgIG91dERpcjogJ3B1YmxpYy9idWlsZC8nLFxuICAgICAgICBjc3NDb2RlU3BsaXQ6IHRydWUsXG5cbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbChbXG4gICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9tYWluLmNzcycsXG4gICAgICAgICAgICAncmVzb3VyY2VzL2pzL21haW4uanMnLFxuICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHBseV9kb2N1bWVudF90eXBlL2FwcGx5X2RvY3VtZW50X3R5cGUuanMnLFxuICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHBseXR5cGUvYXBwbHl0eXBlLmpzJyxcbiAgICAgICAgICAgICdyZXNvdXJjZXMvanMvZW1wbG95ZWVzL2VtcGxveWVlcy5qcycsXG4gICAgICAgICAgICAncmVzb3VyY2VzL2pzL2ZvbGRlcnMvZm9sZGVyLmpzJywgLy8gVXBkYXRlIHRoZSBlbnRyeSBtb2R1bGUgaGVyZVxuICAgICAgICBdKSxcbiAgICAgICAgdml0ZVN0YXRpY0NvcHkoe1xuICAgICAgICAgICAgdGFyZ2V0czogW1xuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL2NzcycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICcnXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIHNyYzogJ3Jlc291cmNlcy9mb250cycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICcnXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIHNyYzogJ3Jlc291cmNlcy9pbWFnZXMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnJ1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdyZXNvdXJjZXMvanMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnJ1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdyZXNvdXJjZXMvbWFwcycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICcnXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIHNyYzogJ3Jlc291cmNlcy9zY3NzJyxcbiAgICAgICAgICAgICAgICAgICAgZGVzdDogJydcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL3BsdWdpbnMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnJ1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdyZXNvdXJjZXMvc2FzcycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICcnXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIF0sXG4gICAgICAgIH0pXG4gICAgXSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUE0UyxTQUFTLG9CQUFvQjtBQUN6VSxPQUFPLGFBQWE7QUFDcEIsU0FBUyxzQkFBc0I7QUFFL0IsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsT0FBTztBQUFBLElBQ0gsVUFBVTtBQUFBLElBQ1YsUUFBUTtBQUFBLElBQ1IsY0FBYztBQUFBLEVBRWxCO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSjtBQUFBLE1BQ0E7QUFBQSxNQUNBO0FBQUEsTUFDQTtBQUFBLE1BQ0E7QUFBQSxNQUNBO0FBQUE7QUFBQSxJQUNKLENBQUM7QUFBQSxJQUNELGVBQWU7QUFBQSxNQUNYLFNBQVM7QUFBQSxRQUNMO0FBQUEsVUFDSSxLQUFLO0FBQUEsVUFDTCxNQUFNO0FBQUEsUUFDVjtBQUFBLFFBQ0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsUUFDQTtBQUFBLFVBQ0ksS0FBSztBQUFBLFVBQ0wsTUFBTTtBQUFBLFFBQ1Y7QUFBQSxRQUNBO0FBQUEsVUFDSSxLQUFLO0FBQUEsVUFDTCxNQUFNO0FBQUEsUUFDVjtBQUFBLFFBQ0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsUUFDQTtBQUFBLFVBQ0ksS0FBSztBQUFBLFVBQ0wsTUFBTTtBQUFBLFFBQ1Y7QUFBQSxRQUNBO0FBQUEsVUFDSSxLQUFLO0FBQUEsVUFDTCxNQUFNO0FBQUEsUUFDVjtBQUFBLFFBQ0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsTUFDSjtBQUFBLElBQ0osQ0FBQztBQUFBLEVBQ0w7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
