@extends('layouts.default')

@section('content')
    <section>
        <x-general.card class="px-4 bg-white">
            <h1 class="font-bold text-lg">
                Product inserted
            </h1>
            <div class="mt-3">
                <table class="w-full mt-3" style="border:1px solid black;border-collapse:collapse;">
                    <thead class="bg-blue-300">
                        <th class="p-2" style="border:1px solid black;">UNIQUE KEY</th>
                        <th class="p-2" style="border:1px solid black;">PRODUCT TITLE</th>
                        <th class="p-2" style="border:1px solid black;">PRODUCT DESCRIPTION</th>
                        <th class="p-2" style="border:1px solid black;">STYLE</th>
                        <th class="p-2" style="border:1px solid black;">SIZE</th>
                        <th class="p-2" style="border:1px solid black;">COLOUR</th>
                        <th class="p-2" style="border:1px solid black;">PRICE PER PIECE</th>
                    </thead>
                    <tbody class="bg-blue-100">
                        @forelse ($data as $item)
                            <tr>
                                <td class="p-2" style="border:1px solid black;">{{ $item->unique_key }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->product_title }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->product_description }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->style }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->size }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->color_name }}</td>
                                <td class="p-2" style="border:1px solid black;">{{ $item->piece_price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-2 text-center" style="border:1px solid black;">No record found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                @if (isset($data))
                    {{$data->links()}}
                @endif
            </div>
        </x-general.card>
    </section>
@endsection
