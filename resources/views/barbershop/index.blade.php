@extends('layouts.barbershop')

@section('title', 'Pangling Barbershop - Modern Booking System')

@section('content')
    <!-- Content will be handled by JavaScript navigation -->
@endsection

@push('scripts')
<script>
// Old barbershop app - deprecated
// Navigation is now handled by the layout's navigation system
document.addEventListener('DOMContentLoaded', function() {
    console.log('Legacy barbershop view loaded - consider using /barbershop route instead');
});
</script>
@endpush