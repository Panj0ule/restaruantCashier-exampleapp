<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Transaction History') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <table class="min-w-full divide-y divide-gray-200">
                      <thead>
                          <tr>
                              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  ID
                              </th>
                              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Customer Name
                              </th>
                              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Items
                              </th>
                              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Total Price
                              </th>
                              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Date
                              </th>
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($transactions as $transaction)
                              <tr>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                      {{ $transaction->id }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      {{ $transaction->customer_name }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      @foreach ($transaction->items as $item)
                                          {{ $item->item->name }} ({{ $item->quantity }} x {{ $item->item_price }})<br>
                                      @endforeach
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      {{ $transaction->total_price }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      {{ $transaction->created_at->format('d-m-Y H:i:s') }}
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                  <div class="mt-4">
                      {{ $transactions->links() }}
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
