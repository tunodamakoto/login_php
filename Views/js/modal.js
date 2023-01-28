const buttonOpen = document.getElementById('modalOpen');
const modal = document.getElementById('modal');
const modalCansel = document.getElementById('modalCansel');
const modalBack = document.getElementById('modalBack');

// プロフィール編集がクリックされたら->modalOpen
buttonOpen.addEventListener('click', function() {
    modal.classList.add("show");
    modalBack.classList.add('show');
});

// キャンセルボタンがクリックされたら->modalClose
modalCansel.addEventListener('click', function() {
    modal.classList.remove("show");
    modalBack.classList.remove('show');
});

// モーダルコンテンツ以外がクリックされたら->modalClose
modalBack.addEventListener('click', function() {
    modal.classList.remove("show");
    modalBack.classList.remove('show');
});

let user = [
    ["たなか","男性"],
    ["すずき","女性"],
    ["さとう","女性"]
 ];
 
 console.log(user);