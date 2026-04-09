-- tài liệu phát triển module cho website giới thiệu doanh nghiệp

\*\* yêu cầu:

1. khi làm phải tuân thủ theo flow của codebase nhé (đầy đủ file, folder, class, method, ... table, relation nhé)
2. Làm phải hoàn chỉnh module từ A-Z nhé (từ migration, model, controller, repository, service, view, route, ...)
3. trước khi làm phải check xem có module tương tự chưa nhé, các component sẵn chưa (nếu có thì dùng lại nhé), đồng thời quan trọng nhất là phải tính nhất quan về giao diện, compoent font, màu sắc, ... nhé (vd cùng 1 filter nhưng bạn làm làm mới style khác với các filter khác trong khi đã có sẵn style cho filter và apply code BE rồi thì không được nhé)
4. ưu tiên độ chính xác, scaleable cao, dễ bảo trì, dễ mở rộng, dễ debug, dễ deploy, dễ maintain và performance cao nhé
5. khi làm phải hoàn thành phải check lại xem còn có lỗi nhỏ, syntax error, hay lỗi logic, ... nhé
6. ưu tiên làm module ít phụ thuộc nhất nhé
7. không được hardcode các giá trị nhé, phải lấy từ config, enum, ... nhé
8. đồng bộ tên bảng hiện tại dùng table_catalogues (đối với nhóm table và column)
9. khi làm có bất kỳ lỗi nào sau khi chạy prompt này phải note lại vào doc này ngay phần lưu ý để tránh lỗi lập lại tỏng module sau nhé
10. các compoent dùng ít nhất 2 lần trở lên tách compoent dùng lại nhé và được để trong path: resources\views\backend\dashboard\component đối với compoennt dùng trong các store admin quản lý
11. sidebar custom đúng link route cho chính module đang phát triển nhé
12. phải có fallback cho các trường hợp không có dữ liệu nhé ví dụ như giá tiền đang k có nếu k hiện cảm tháy thiếu trải nghiệm ng dùng nên để là 0đ kiểu vậy nhé chỉ ở index table thôi nhé -. trong store thì không được nhé
13. có thắc mải phải có câu hỏi nhé, tránh việc thích làm gì làm sai yêu cầu
14. độ chính xác working tốt của module -> đảm bảo 100% nhé
15. tránh việc khi làm ảnh hướng đến module xung quanh nhé, sửa này thêm này mà module kia bị lỗi thì không được nhé
16. tham khảo các module có sẵn như posts, products (nó đã phát triển gần như ok rồi nhé) để biết cách làm nhé
17. field trong các bảng phải đủ phục vụ cho các chức năng của module nhé (tránh thiếu đơn giản -> phải thêm lại từng field rất mất tgian nhé)
18. không được mơ hồ, cẩu thả, thiếu logic nhé -> phải đầy đủ thông tin trước khi làm nhé nếu làm lần đầu có thể lâu nhưng những lần sau sẽ nhanh hơn rất nhiều nhé
19. tránh query N+1 nhé, nếu có thì phải tối ưu nhé, check phương pháp tốt nhất nhé, giảm query, tối ưu performance nhé
20. sắp xếp bố cục layout gọn gàn margin padding đều nhau dễ nhìn, dễ dùng, dễ thao tác nhé -> dồng bộ layout nhé (về đồng bộ layout vd như sau các module truocs có cột publish thì hiển thị sidebar bên phải, thì các module sau cũng phải y chang nhé, tránh sai vị trí đồng bộ,...)

\*\* kết quả mong muốn:

- 1 module hoàn chỉnh working tốt trên mọi hình thức, không lỗi, không thiếu tính năng, field,
- scalable tốt, performance loading nhanh < 1s, dễ maintain sau này

**Lưu ý**:

- không được miss các yêu cầu trên nhé làm xong phải rà soát lại có thiếu yêu cầu nào không nhé (quan trọng)
- các field cần số liệu chính xác như giá tiền dùng decimal 10,2 nhé
- khi nhắc đến phát triển module là phát triển cho cả admin và frontend nhé, từ module chính, module nhóm, language,... liên quan là mới tính 1 module nhé (trừ khi có yêu cầu khác)
- nếu layout chưa dựng có thể tham khảo các layout đã có sẵn trong codebase nhé (của velzon -> nhưng cần phải custom về chính của mình nhé tránh có thương hiệu của velzon nhé y chang layout cũng được): public\vendor\dist\
- lên plan bằng tiếng việt nhé
- **Luôn sử dụng `parent_id` (có dấu gạch dưới) cho tất cả các cột phân cấp trong database** (vd: parent_id thay vì parentid) để đảm bảo tương thích hoàn toàn với thư viện `Nestedsetbie` và các logic xử lý cây thư mục trong codebase.
- **Truyền biến `$thisLanguage` vào View**: Khi hiển thị danh sách (index), nếu View cần lọc dữ liệu theo ngôn ngữ hiện tại (ví dụ: hiển thị tên nhóm/danh mục qua pivot table), bắt buộc phải truyền biến `$thisLanguage` (lấy từ `$this->language` trong Controller) qua hàm `compact()`. Thiếu biến này sẽ dẫn đến lỗi `Undefined variable $thisLanguage` trong Blade.
- **Xử lý lỗi `BindingResolutionException`**: Khi tạo Repository mới, bắt buộc phải đăng ký cặp `Interface => Concrete` trong `RepositoryServiceProvider.php`. Để tránh lỗi `Target [...] is not instantiable`, hãy luôn sử dụng **Interface** để type-hint trong Controller/Service thay vì lớp Concrete. Nếu đã cấu hình đúng mà vẫn lỗi, hãy chạy lệnh `php artisan config:clear` để xóa cache cấu hình.
- **Quy tắc màu sắc Nút bấm (Button)**: Để đồng bộ hóa trải nghiệm người dùng, các nút "Thêm mới" hoặc "Thêm dòng" (Ví dụ: Thêm tính năng, Thêm bản ghi) bắt buộc phải sử dụng màu mã `success` (Lưu ý: dùng class `btn-soft-success` cho các module hiện đại hoặc `btn-success` theo yêu cầu). Tránh sử dụng màu `primary` cho các thao tác thêm mới hàng loạt hoặc tính năng nhỏ bên trong card.
- **Kiểm tra cú pháp JavaScript**: Luôn kiểm tra kỹ các file JS trong `public/backend/library/` sau khi tạo mới, đặc biệt là các ký tự lạ hoặc lỗi cú pháp (syntax error) vì chúng có thể gây ngừng hoạt động toàn bộ script điều hướng của module.
- **Lỗi PHP báo thiếu method interface dù code đã có**: Nếu gặp fatal kiểu `Class ... contains 1 abstract method ... must implement ...::findByCondition` nhưng trong file Service đã có method đó, khả năng cao là **cache/opcache/autoload** đang giữ bản cũ. Cách xử lý nhanh: chạy `php artisan optimize:clear` (hoặc `config:clear && route:clear && view:clear && cache:clear`) và **restart** PHP-FPM/Apache hoặc dừng/chạy lại `php artisan serve`.
- **Toggle cho trạng thái đặc biệt**: Đối với các trường như `Đề xuất` (Recommend/Best Seller), sử dụng class `form-check-danger` trên thẻ div `form-check` để hiển thị màu đỏ khi được kích hoạt, phân biệt với màu xanh (`success`) của trạng thái `Publish`.
- **Tính năng chọn lại (Datalist)**: Để tăng trải nghiệm người dùng khi nhập liệu các thông tin lặp lại (ví dụ: Danh sách tính năng), sử dụng thành phần `<datalist>` kết hợp với input text. Dữ liệu gợi ý được thu thập từ các bản ghi hiện có thông qua Repository phương thức `getFeatures()`.
- **Quy tắc đặt tên Middleware**: Khi khai báo Route Group cho Backend, luôn sử dụng đúng các alias đã đăng ký trong `Kernel.php`. - Sử dụng `'locale'` (THAY VÌ `set_locale`) để thiết lập ngôn ngữ dựa trên session. - Sử dụng `'admin'` cho `AuthenticateMiddleware`. - Sử dụng `'backend_default_locale'` để thiết lập ngôn ngữ mặc định cho admin. - Sai sót trong tên alias sẽ dẫn đến lỗi `Target class [alias] does not exist`.
  50: - **Xử lý lỗi `302 Found` khi Store/Update**: Nếu gặp lỗi này mà không thấy thông báo lỗi, hãy kiểm tra: 1. **Validation**: `name` và `canonical` (phải duy nhất trong bảng `routers`). 2. **Logic Pivot**: Trong Service, khi gọi `createPivot`, bắt buộc phải truyền `$languageId` làm tham số thứ 4: `$this->repository->createPivot($model, $payload, 'languages', $languageId)`. Nếu không truyền, hệ thống sẽ mặc định lấy `$model->id` làm ID quan hệ, dẫn đến lỗi logic DB và gây 302 redirect back. 3. **Detach sai ID**: Đảm bảo `detach($languageId)` thay vì `detach([$languageId, $model->id])`. 4. **Model Fillable**: Kiểm tra thuộc tính `$fillable` trong Model đã bao gồm các trường `NOT NULL` được truyền từ Service chưa (ví dụ: `user_id`). Nếu thiếu, Eloquent sẽ bỏ qua trường đó và gây lỗi DB, dẫn đến 302 redirect back.
- **Lỗi `Attempt to read property "..." on null` trong Model**:
    1. Thường xảy ra trong các hàm static như `isNodeCheck` khi gọi `find($id)` mà không kiểm tra kết quả trả về trước khi truy cập thuộc tính (ví dụ: `->rgt`, `->lft`).
    2. **Cách sửa**: Luôn sử dụng `self::find($id)` thay vì gọi tên Model đầy đủ bên trong chính nó, và thêm bước kiểm tra `if(!$variable) return true` (hoặc false tùy logic) để xử lý trường hợp ID không tồn tại hoặc bản ghi đã bị xóa.
