<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-800">{{__('messages.orderId')}} {{ $transaction->id }}</h2>
        <span class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y') }}</span>
    </div>
    <div class="text-sm text-gray-600 mb-2">
        <strong>{{__('messages.t.name')}}</strong> {{ $transaction->user->name }}
    </div>
    <div class="text-sm text-gray-600 mb-2">
        <strong>{{__('messages.t.merch')}}</strong> {{ $transaction->merch->name }}
    </div>
    <div class="text-sm text-gray-600 mb-2">
        <strong>{{__('messages.t.total')}}Rp</strong> ${{ $transaction->total_price }}
    </div>
    <div class="text-sm text-gray-600 mb-4">
        <strong>{{__('messages.t.status')}}</strong> 
        <span class="px-2 py-1 rounded {{ $transaction->status === 'Success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $transaction->status }}
        </span>
    </div>
    <a href="{{ route('send.receipt', $transaction->id) }}" class="block text-center text-sm font-medium text-indigo-600 hover:underline">
        {{__('messages.t.send')}}
    </a>
</div>