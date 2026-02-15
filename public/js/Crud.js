$(document).ready(function(){
    document.addEventListener("click", function (e) {
        let btn = e.target.closest(".modal-crud");
        if (!btn) return;

        let url = btn.getAttribute("data-url");
        let modal = document.getElementById("crudModal");

        // buka modal
        modal.classList.remove("hidden");

        // load konten
        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById("modalContent").innerHTML = html;
            });
    });

    document.addEventListener("click", function (e) {
        let btn = e.target.closest(".detail-modal-crud");
        if (!btn) return;

        let url = btn.getAttribute("data-url-detail");
        let modal = document.getElementById("DetailCrudModal");

        // buka modal
        modal.classList.remove("hidden");

        // load konten
        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById("detailModalContent").innerHTML = html;
            });
    });
})
