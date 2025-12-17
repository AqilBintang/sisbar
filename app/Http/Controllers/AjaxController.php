<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserInterfaceService;

class AjaxController extends Controller
{
    protected $uiService;

    public function __construct(UserInterfaceService $uiService)
    {
        $this->uiService = $uiService;
    }

    /**
     * Load services page content via AJAX
     */
    public function loadServices()
    {
        try {
            $services = $this->uiService->getServices();
            
            $html = view('components.service-list-dynamic', compact('services'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html,
                'count' => $services->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load services',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Load barbers page content via AJAX
     */
    public function loadBarbers()
    {
        try {
            $barbers = $this->uiService->getBarbers();
            
            $html = view('components.barber-profile', compact('barbers'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html,
                'count' => $barbers->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load barbers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Load gallery page content via AJAX
     */
    public function loadGallery()
    {
        try {
            $html = view('components.gallery-section')->render();
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load gallery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get navigation data for preloading
     */
    public function getNavigationData()
    {
        try {
            $data = $this->uiService->getNavigationData();
            
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load navigation data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Preload critical resources
     */
    public function preloadResources(Request $request)
    {
        $pages = $request->input('pages', []);
        $results = [];

        foreach ($pages as $page) {
            try {
                switch ($page) {
                    case 'services':
                        $services = $this->uiService->getServices();
                        $results[$page] = [
                            'success' => true,
                            'count' => $services->count(),
                            'cached' => true
                        ];
                        break;
                        
                    case 'barbers':
                        $barbers = $this->uiService->getBarbers();
                        $results[$page] = [
                            'success' => true,
                            'count' => $barbers->count(),
                            'cached' => true
                        ];
                        break;
                        
                    default:
                        $results[$page] = [
                            'success' => false,
                            'message' => 'Unknown page'
                        ];
                }
            } catch (\Exception $e) {
                $results[$page] = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }
}