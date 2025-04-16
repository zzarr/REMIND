@extends('tim.layout.app')

@section('title', 'Kuisioner - ' . ucfirst($jenis))

@section('content')
    <livewire:kuisioner-step :pasien_id="$pasien_id" :jenis="$jenis" />
@endsection
