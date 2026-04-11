# 🖼️ Hướng Dẫn Clone Giao Diện Từ Ảnh

---

## 1. Quy Trình Tổng Quan

```
Ảnh thiết kế
    → Phân tích Layout (zone, grid, spacing)
    → Ánh xạ Design System token có sẵn
    → Xác định nguồn data
         ├─ DB/API có → dùng thật
         ├─ Chưa có   → auto mock (faker)
         └─ Lỗi/rỗng  → hardtext fallback
    → Render component
```

---

## 2. Phân Tích Ảnh

Trước khi code, xác định nhanh:

| Hạng mục      | Cần xác định                                                  |
| ------------- | ------------------------------------------------------------- |
| **Layout**    | Số cột, có sidebar không, fixed header?                       |
| **Màu sắc**   | Ánh xạ sang token có sẵn (`primary`, `surface`, `muted`...)   |
| **Spacing**   | Ước theo bội số 4/8px → ánh xạ sang scale (`p-4`, `gap-6`...) |
| **Component** | Cái nào đã có trong design system? Cái nào cần tạo mới?       |
| **Data**      | Vùng nào động? Loại data gì? API nào cấp?                     |

---

## 3. Nguyên Tắc Khi Code

```
✅ Giữ nguyên tỉ lệ grid/cột từ ảnh gốc
✅ Dùng token design system — KHÔNG hardcode màu/spacing
✅ Tận dụng component có sẵn trước khi tạo mới
✅ Luôn có trạng thái loading (Skeleton)
✅ Luôn có trạng thái rỗng (EmptyState)
```

---

## 4. Chiến Lược Data

### Thứ tự ưu tiên

### Pattern hook chuẩn

### Auto mock factory mẫu

## 5. Fallback Cứng — Khi Nào Dùng

---

## 7. Checklist Trước Khi Commit

```
[ ] Layout khớp ảnh gốc (grid, spacing, tỉ lệ cột)
[ ] Không có màu / spacing hardcode — dùng token
[ ] Empty state hoạt động (không crash khi data = [])
[ ] Mock chạy được khi tắt API
[ ] Responsive đúng breakpoint đã xác định
[ ] TÍnh đồng bộ nhất quán
[ ] Tái sử dụng có sẵn k làm mới khi đã có
[ ] khi có code theo ảnh thì chỉ quan tâm cấu trúc layout của giao diện nhé  (cấu trúc chuẩn từng px nhé)
[ ] các section or title badge ... không mock từ đb ra phải việt hóa rõ ràng
[] trước khi bàn giao phải k còn tồn tại lỗi

```

lưu ý khi có sửa sau mỗi làn chạy note vào bên dưới này để sau này k gặp lại nữa
