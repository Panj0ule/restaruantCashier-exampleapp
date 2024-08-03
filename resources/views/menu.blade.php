<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Menu') }}
      </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form id="transaction-form" action="{{ route('transactions.store') }}" method="POST">
      @csrf
      <div class="w-full max-w-md">
          <div class="flex items-center border-b border-blue-500 py-2">
              <input name="customer_name" id="customer-name" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Insert Customer Name" aria-label="Full name" required>
              <button id="start-transaction-btn" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                  Start Transaction
              </button>
              <button type="button" class="flex-shrink-0 border-transparent border-4 text-blue-500 hover:text-blue-800 text-sm py-1 px-2 rounded" onclick="resetForm()">
                  Cancel
              </button>
          </div>
      </div>
      <div id="items-container" class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-4" style="display: none;">
          @foreach ($items as $item)
          <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
              <a href="#">
                  <img class="rounded-t-lg" src="https://placehold.co/600x400" alt="" />
              </a>
              <div class="p-5">
                  <a href="#">
                      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item['name'] }}</h5>
                  </a>
                  <p class="mb-3 font-normal text-gray-700">{{ $item['price'] }}</p>
                  <div class="max-w-xs mx-auto">
                      <label for="quantity-{{ $item['id'] }}" class="block mb-1 text-sm font-medium text-gray-900">Choose quantity:</label>
                      <div class="relative flex items-center">
                          <button type="button" onclick="decrementQuantity({{ $item['id'] }})" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                              <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                              </svg>
                          </button>
                          <input type="number" name="items[{{ $item['id'] }}][quantity]" id="quantity-{{ $item['id'] }}" class="flex-shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[3.5rem] text-center" value="0" min="0" required>
                          <input type="hidden" name="items[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                          <button type="button" onclick="incrementQuantity({{ $item['id'] }})" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                              <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                              </svg>
                          </button>
                      </div>
                  </div>
                  <button type="button" onclick="addItemToTransaction({{ $item['id'] }})" class="mt-5 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                      Add
                      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                      </svg>
                  </button>
              </div>
          </div>
          @endforeach
      </div>
      <div id="order-summary" class="mt-10"></div>
      <button id="finish-transaction-btn" type="button" class="mt-5 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300" style="display: none;">
          Finish Transaction
      </button>
    </div>
  </form>

  <!-- Success Modal -->
  <div id="success-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto">
    <div class="relative w-full max-w-md mx-auto mt-20">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="success-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-14 h-14 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Transaction completed successfully!</h3>
                <button id="ok-btn" data-modal-toggle="success-modal" type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">OK</button>
            </div>
        </div>
    </div>
  </div>

  <script>
    document.getElementById('start-transaction-btn').addEventListener('click', function() {
      const customerName = document.getElementById('customer-name').value;
      if (customerName.trim() === '') {
        alert('Please enter a customer name.');
        return;
      }

      document.getElementById('items-container').style.display = 'grid';
      document.getElementById('finish-transaction-btn').style.display = 'inline-flex';
      this.disabled = true; // Disable the button to prevent multiple clicks
    });

    function incrementQuantity(id) {
      const input = document.getElementById(`quantity-${id}`);
      input.value = parseInt(input.value) + 1;
    }

    function decrementQuantity(id) {
      const input = document.getElementById(`quantity-${id}`);
      if (input.value > 0) {
        input.value = parseInt(input.value) - 1;
      }
    }

    function resetForm() {
      document.getElementById('transaction-form').reset();
      document.getElementById('items-container').style.display = 'none';
      document.getElementById('finish-transaction-btn').style.display = 'none';
      document.getElementById('start-transaction-btn').disabled = false;
    }

    function addItemToTransaction(id) {
      const input = document.getElementById(`quantity-${id}`);
      const quantity = parseInt(input.value);
      const itemName = document.querySelector(`#quantity-${id}`).closest('.p-5').querySelector('h5').textContent;
      const itemPrice = parseFloat(document.querySelector(`#quantity-${id}`).closest('.p-5').querySelector('p').textContent.replace('Rp ', '').replace(',', '.'));

      if (quantity <= 0) {
        alert('Please enter a valid quantity.');
        return;
      }

      if (!selectedItems[id]) {
        selectedItems[id] = { name: itemName, quantity: 0, price: itemPrice };
      }

      selectedItems[id].quantity += quantity;
      totalPrice += quantity * itemPrice;

      updateOrderSummary();
    }

    let selectedItems = {};
    let totalPrice = 0;

    function updateOrderSummary() {
      const summary = document.getElementById('order-summary');
      summary.innerHTML = '<h3 class="text-lg font-semibold">Order Summary</h3>';

      for (const [id, item] of Object.entries(selectedItems)) {
        summary.innerHTML += `
          <div>
            ${item.name} -  ${item.quantity}x - Price: ${item.price.toFixed(2)}
          </div>
        `;
      }

      summary.innerHTML += `
        <div class="mt-4 font-semibold">Total Price: ${totalPrice.toFixed(2)}</div>
      `;
    }

    document.getElementById('finish-transaction-btn').addEventListener('click', function() {
      const form = document.getElementById('transaction-form');
      const formData = new FormData(form);

      fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
              'X-Requested-With': 'XMLHttpRequest',
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // Show success modal
              document.getElementById('success-modal').classList.remove('hidden');
          } else {
              // Handle error
              alert('An error occurred: ' + (data.message || 'Unknown error'));
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('An unexpected error occurred.');
      });
    });

  document.getElementById('ok-btn').addEventListener('click', function() {
      document.getElementById('success-modal').classList.add('hidden');
      resetForm();
  });

  function resetForm() {
      document.getElementById('transaction-form').reset();
      document.getElementById('items-container').style.display = 'none';
      document.getElementById('finish-transaction-btn').style.display = 'none';
      document.getElementById('start-transaction-btn').disabled = false;
      selectedItems = {};
      totalPrice = 0;
      updateOrderSummary(); // Clear order summary
  }


  </script>
</x-app-layout>
