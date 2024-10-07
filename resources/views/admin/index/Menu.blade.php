@extends('admin.layouts.master')

@section('content')
<body>
    <div class="container">
        <h1>Menu của Nhà Hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Món</th>
                    <th>Hình Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItem as $item)
                <tr>
                    <td>
                        <form action="{{ route('admin.menu.edit', $loop->index) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="text" name="tenMon" value="{{ $item['tenMon'] }}" required>
                            <input type="number" name="gia" value="{{ $item['gia'] }}" required>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </td>
                    {{-- <td>{{ number_format($item['gia'], 0, ',', '.') }}đ</td> --}}
                    <td>
                        <img src="{{ asset($item['hinhAnh']) }}" alt="{{ $item['tenMon'] }}" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <form action="{{ route('admin.menu.delete', $loop->index) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?');" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Nút thêm món ở cuối trang -->
        <button id="addMenuItemBtn" class="btn btn-success">Thêm Món</button>

        <!-- Form thêm món, ẩn ban đầu -->
        <div id="newMenuItemForm" style="display: none; margin-top: 20px;">
            <h2>Thêm Món Mới</h2>
            <form action="{{ route('admin.menu.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tenMon">Tên Món:</label>
                    <input type="text" id="tenMon" name="tenMon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gia">Giá:</label>
                    <input type="number" id="gia" name="gia" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="hinhAnh">Hình Ảnh:</label>
                    <input type="file" id="hinhAnh" name="hinhAnh" accept="image/*" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="moTa">Mô Tả:</label>
                    <textarea id="moTa" name="moTa" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="loaiMon">Loại Món:</label>
                    <input type="text" id="loaiMon" name="loaiMon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tuyChon">Tùy Chọn:</label>
                    <input type="text" id="tuyChon" name="tuyChon" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Thêm Món</button>
                <button type="button" id="cancelBtn" class="btn btn-secondary">Hủy</button>
            </form>
        </div>
    </div>

    <!-- JavaScript để điều khiển hiển thị form -->
    <script>
        document.getElementById('addMenuItemBtn').addEventListener('click', function() {
            document.getElementById('newMenuItemForm').style.display = 'block';
        });

        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('newMenuItemForm').style.display = 'none';
        });
    </script>
</body>
@endsection
