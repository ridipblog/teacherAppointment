import AdminSupport from './AdminSupport.js';
const adminSupportObj = new AdminSupport();
$(document).ready(function () {

    // *** Append Vacency Details Form ***
    $(document).on('click', '#append-form', async function () {
        try {
            const container = document.getElementById('vacancyRows');
            const newRow = document.createElement('div');
            newRow.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 vacancy-row';
            newRow.innerHTML = `
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Vacancy Code</label>
        <input type="text" name="vacancyCode[]" placeholder="Vacancy Code"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Replace Person Name</label>
        <div class="flex gap-2">
          <input type="text" name="replacePerson[]" placeholder="Replace Person Name"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            required>
          <button type="button" class="text-red-600 hover:underline font-medium" id="remove-form">Remove</button>
        </div>
      </div>
    `;
            container.appendChild(newRow);
        } catch (error) {
            Swal.fire("Can not append row , Initialized error execute!");
        }
    });

    // *** Remove Form Row ***
    $(document).on('click', '#remove-form', async function () {
        try {
            let button = $(this);
            const row = button.closest('.vacancy-row');
            if (document.querySelectorAll('.vacancy-row').length > 1) {
                row.remove();
            } else {
                Swal.fire("At least one vacancy row is required.");
            }
        } catch (error) {
            Swal.fire("Can not remove vacency, Initialized error execute!");
        }
    });

    // *** Login Process ***
    $(document).on('submit', '#add-school-vacency-form', async function (e) {
        try {
            e.preventDefault();
            adminSupportObj.addSchoolVacency('#add-school-vacency-form');
        } catch (error) {
            Swal.fire("Can not add vacency, Initialized error execute!");
        }
    });
});
