@extends('layouts.store')
@section('title', 'Hubungi Kami - FANES.GO')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Hubungi Kami</h1>
        <p class="text-gray-600 mt-2">Punya kritik dan saran? Kami siap melayani.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 items-start">

        {{-- INFORMASI KONTAK --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-1 h-6 bg-green-600 rounded-full mr-3"></span>
                Informasi Kontak
            </h3>

            <div class="space-y-6">

                {{-- ALAMAT --}}
                <div class="flex items-start p-4 hover:bg-green-50 rounded-xl transition">
                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4">
                        📍
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Alamat</h4>
                        <p class="text-gray-600 text-sm mt-1">Bengkalis, Riau, Indonesia</p>
                    </div>
                </div>

                {{-- WHATSAPP --}}
                <a href="https://wa.me/62895323932558"
                    target="_blank"
                    class="flex items-start p-4 hover:bg-green-50 rounded-xl transition">

                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4">
                        📞
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Telepon / WhatsApp</h4>
                        <p class="text-gray-600 text-sm mt-1">+62 895-3239-32558</p>
                    </div>
                </a>

                {{-- EMAIL --}}
                <div class="flex items-start p-4 hover:bg-green-50 rounded-xl transition">
                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4">
                        ✉️
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Email</h4>
                        <p class="text-gray-600 text-sm mt-1">fanesgo@gmail.com</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- FORM KIRIM PESAN KE WHATSAPP --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-1 h-6 bg-green-600 rounded-full mr-3"></span>
                Kirim Pesan
            </h3>

            <form onsubmit="kirimKeWhatsapp(event)">
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Nama
                    </label>
                    <input id="nama"
                        type="text"
                        required
                        class="w-full px-4 py-3 rounded-lg border focus:ring-2 focus:ring-green-200"
                        placeholder="Nama Anda">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Pesan
                    </label>
                    <textarea id="pesan"
                        required
                        class="w-full px-4 py-3 rounded-lg border h-32 resize-none focus:ring-2 focus:ring-green-200"
                        placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">
                    Kirim via WhatsApp
                </button>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT WHATSAPP --}}
<script>
    function kirimKeWhatsapp(e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value;
        const pesan = document.getElementById('pesan').value;

        const nomor = '62895323932558';

        const text = encodeURIComponent(
            `Halo FANES.GO, Saya ${nama} ingin memberi kritik dan saran sebagai berikut:\n\n` +
            `"${pesan}"\n\n` +
            `Sekian, Terima Kasih.`
        );

        window.open(`https://wa.me/${nomor}?text=${text}`, '_blank');
    }
</script>

@endsection