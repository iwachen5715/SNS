$(function () {
  $('.menu-btn').click(function ()
  //オレンジ色のタグはclassタグ
  {
    $(this).toggleClass('is-open');
    //toggleClassメソッドは クラスの追加 と クラスの削除を切り替える仕組みを持つメソッド（要するに表示と非表示を切り替えを得意とするメソッド）
    $(this).siblings('.menu').toggleClass('is-open');
    //siblings()メソッドとは、指定した要素の兄弟要素を全て対象にするメソッドであり、指定したセレクタの要素と同じ階層にある要素を全て取得することができます。
  });
});
