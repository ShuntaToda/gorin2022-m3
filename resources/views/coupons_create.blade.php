@include('header', ['title' => 'クーポン新規登録'])
<nav class="mb-3">
    <a href="{{ route('coupons_list') }}" class="btn btn-outline-primary">クーポン一覧へ戻る</a>
</nav>
<main>
    <form action="{{ route('coupons_create') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label  class="form-label">クーポンコード</label>
          <input type="text" class="form-control" name="coupon_code">
        </div>
        <div class="mb-3">
          <label  class="form-label">割引額</label>
          <input type="number" class="form-control" name="discount_price">
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