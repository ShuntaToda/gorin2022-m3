@include('header', ['title' => '商品編集'])
<nav class="mb-3">
    <a href="{{ route('home') }}" class="btn btn-outline-primary">ホームへ戻る</a>
</nav>
<main>
    <form action="{{ route('items_edit', $item->id) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label  class="form-label">商品名</label>
          <input type="text" class="form-control" name="name" value="{{ $item->name }}">
        </div>
        <div class="mb-3">
          <label  class="form-label">値段</label>
          <input type="number" class="form-control" name="price" value="{{ $item->price }}">
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
        @if ($errors->any())
            <span class="ms-3">エラーが発生しました</span>
        @endif
        @isset($message)
            <span class="ms-3">{{ $message }}</span>
        @endisset
      </form>

</main>


@include('footer')