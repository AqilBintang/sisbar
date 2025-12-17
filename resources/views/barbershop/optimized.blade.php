@extends('layouts.optimized-barbershop')

@section('title', 'Sisbar Hairstudio - Optimized Experience')

@section('content')
    <!-- Content will be handled by optimized JavaScript navigation -->
@endsection

@push('scripts')
<script>
// Initialize the optimized barbershop app
document.addEventListener('DOMContentLoaded', function() {
    // App is initialized in optimized-navigation.js
    console.log('Optimized Barbershop App loaded');
});
</script>
@endpush