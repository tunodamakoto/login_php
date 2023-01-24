const buttonOpen = document.getElementById('modalOpen');
const modal = document.getElementById('modal');
const modalBack = document.getElementById('modalBack');

// プロフィール編集がクリックされたら->modalOpen
buttonOpen.addEventListener('click', function() {
    modal.classList.add("show");
    modalBack.classList.add('show');
});

// モーダルコンテンツ以外がクリックされたら->modalClose
modalBack.addEventListener('click', function() {
    modal.classList.remove("show");
    modalBack.classList.remove('show');
});