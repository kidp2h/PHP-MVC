const Modal = {
    openImageAdmin() {
        $$('.addImage').forEach((btn) => {
            btn.onclick = function () {
                $('.btn-addImage').onclick = function () {
                    $('#inputUploadImage').click();
                };
                $('.overlayAddImage').style.display = 'flex';
                $('.modal-addImage').style.transform = 'translateY(0px)';
                Product.loadImageToModal(btn.dataset.image, true);
                // TableEvent.Product.SaveImage();
                // TableEvent.Product.RemoveImage();
                // $('.btn-saveImage').setAttribute('data-id', id);
                // $('.btn-saveImage').setAttribute('type', 'product');
            };
        });

    },

    openImageAdminStore() {
        $$('.addImage').forEach((btn) => {
            btn.onclick = function () {
                $('.overlayAddImage').style.display = 'flex';
                $('.modal-addImage').style.transform = 'translateY(0px)';
                Product.loadImageToModal(btn.dataset.image);
            };
        });
    },

    closeImageAdmin() {

        $('#close-modal').onclick = function () {
            $('.modal').style.transform = 'translateY(-600px)';
            $('#inputUploadImage').value = '';
            setTimeout(() => {
                $('.overlayAddImage').style.display = 'none';
            }, 300);
        };

        $('#close-detail').onclick = function () {
            $('.modal-seeDetail').style.transform = 'translateY(-600px)';
            setTimeout(() => {
                $('.overlayDetail').style.display = 'none';
            }, 300);
        };

    },

    closeImageAdminStore() {

        $('#close-modal').onclick = function () {
            $('.modal').style.transform = 'translateY(-600px)';
            setTimeout(() => {
                $('.overlayAddImage').style.display = 'none';
            }, 300);
        };

        $('#close-detail').onclick = function () {
            $('.modal-seeDetail').style.transform = 'translateY(-600px)';
            setTimeout(() => {
                $('.overlayDetail').style.display = 'none';
            }, 300);
        };
    },

    openDetails() {
        $$('.see-detail').forEach( (btn) => {
            btn.onclick = async () => {
                $('.overlayDetail').style.display = 'flex';
                let id = btn.dataset.id;
                let store = btn.dataset.store;
                $('.modal-seeDetail').style.transform = 'translateY(0px)';
                let row = ``;
                let table = $('.product-show tbody');
                table.innerHTML = row;
                let products = await HttpRequest({ url: `/order/details/${store}?id=${id}` });
     
                products.forEach((item) => {

                row += `<tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${item.productPrice * item.quantity}</td>
                </tr>`;
                });
                table.innerHTML = row;
            }
        })
    },

    init() {

        if (!checkUrl('admin')) return;

        if (checkUrl('store')) {
            this.openImageAdminStore();
            this.closeImageAdminStore();
        }
        else {
            this.openImageAdmin();
            this.closeImageAdmin();
        }

        this.openDetails();
    }
}

Modal.init()




