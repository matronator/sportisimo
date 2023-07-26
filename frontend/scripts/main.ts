import * as M from 'materialize-css';
import {
    Axette, noFlashUrl
} from '../../node_modules/.pnpm/axette@2.0.7/node_modules/axette/dist/axette';

const axette = new Axette('.ajax');
axette.onAfterAjax(() => {
    initModals();
});

document.addEventListener('DOMContentLoaded', function() {
    initModals();
    noFlashUrl();
});

function initModals() {
    const elems = document.querySelectorAll('.modal');
    M.Modal.init(elems, {});

    const editBrandBtns = document.querySelectorAll('[data-brand-id]');
    if (editBrandBtns) {
        editBrandBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const brandModalTitle = document.getElementById('brandModalTitle') as HTMLElement;
                brandModalTitle.innerText = 'Edit brand';

                const brandId = btn.getAttribute('data-brand-id') ?? '';
                const brandName = btn.getAttribute('data-brand-name') ?? '';

                const brandNameInput = (document.getElementById('brandNameInput')?.querySelector('input')) as HTMLInputElement;
                const brandIdInput = (document.getElementById('brandIdInput')?.querySelector('input')) as HTMLInputElement;
                brandNameInput.value = brandName;
                brandIdInput.value = brandId;
            });
        });
    }

    const addBrandModalBtn = document.getElementById('addBrandModalBtn');
    if (addBrandModalBtn) {
        addBrandModalBtn.addEventListener('click', () => {
            const brandModalTitle = document.getElementById('brandModalTitle') as HTMLElement;
            brandModalTitle.innerText = 'Add new brand';

            const brandNameInput = (document.getElementById('brandNameInput')?.querySelector('input')) as HTMLInputElement;
            const brandIdInput = (document.getElementById('brandIdInput')?.querySelector('input')) as HTMLInputElement;
            brandIdInput.value = '';
            brandNameInput.value = '';
        });
    }
}
