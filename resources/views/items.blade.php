@include('header', ['title' => '商品情報リスト'])

<nav class="mb-3">
    <a href="{{ route('logout') }}" class="btn btn-outline-danger">ログアウト</a>
    <a href="{{ route('items_create') }}" class="btn btn-outline-primary">商品新規登録</a>
    <a href="{{ route('coupons_list') }}" class="btn btn-outline-primary">クーポン一覧</a>
</nav>
<main>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">商品名</th>
            <th scope="col">値段</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td class="d-flex">
                        <a href="{{ route('items_edit', $item->id) }}" class="btn btn-outline-primary">編集</a>
                        <form action="{{ route('items_delete', $item->id) }}" class="mx-2" onsubmit="return check()">
                            <button class="btn btn-outline-danger" type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</main>


@include('footer')