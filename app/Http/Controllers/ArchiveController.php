<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ArchiveController extends Controller
{
    /**
     * Serve the archived index page through Laravel.
     */
    public function index(Request $request): Response
    {
        $htmlPath = base_path('arsip/Archive/index.html');
        if (! File::exists($htmlPath)) {
            abort(404, 'Archive index not found');
        }

        $html = File::get($htmlPath);

        // Rewrite links to route-friendly paths
        $html = $this->rewriteLinks($html);

        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Serve the archived register page through Laravel.
     */
    public function register(Request $request): Response
    {
        $htmlPath = base_path('arsip/Archive/register.html');
        if (! File::exists($htmlPath)) {
            abort(404, 'Archive register not found');
        }

        $html = File::get($htmlPath);
        $html = $this->rewriteLinks($html);

        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Serve the archived success page through Laravel.
     */
    public function success(Request $request): Response
    {
        $htmlPath = base_path('arsip/Archive/success.html');
        if (! File::exists($htmlPath)) {
            abort(404, 'Archive success not found');
        }

        $html = File::get($htmlPath);
        $html = $this->rewriteLinks($html);

        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Serve assets stored under arsip/Archive/assets via a Laravel route.
     */
    public function asset(string $path): BinaryFileResponse
    {
        // Support assets located either in repo root /assets or in arsip/Archive/assets
        $candidateBaseDirs = [
            base_path('assets'),
            base_path('arsip/Archive/assets'),
        ];

        $resolvedPath = null;
        foreach ($candidateBaseDirs as $baseDir) {
            $baseReal = realpath($baseDir);
            if ($baseReal === false) {
                continue;
            }
            $fullPath = realpath($baseReal . DIRECTORY_SEPARATOR . $path);
            if ($fullPath !== false && strpos($fullPath, $baseReal) === 0 && File::exists($fullPath)) {
                $resolvedPath = $fullPath;
                break;
            }
        }

        if (! $resolvedPath) {
            abort(404);
        }

        $extension = pathinfo($resolvedPath, PATHINFO_EXTENSION);
        $mimeType = match (strtolower($extension)) {
            'css' => 'text/css; charset=UTF-8',
            'js' => 'application/javascript; charset=UTF-8',
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'json' => 'application/json; charset=UTF-8',
            default => (File::mimeType($resolvedPath) ?: 'application/octet-stream'),
        };

        return response()->file($resolvedPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    /**
     * Adjust hardcoded paths in static HTML to Laravel routes.
     */
    private function rewriteLinks(string $html): string
    {
        // Point /assets/... to our Laravel-served assets (keeps same prefix)
        // Ensure register/success use Laravel routes (avoid conflict with auth register)
        $replacements = [
            '/register.html' => '/event/register',
            '/success.html' => '/event/success',
        ];

        return strtr($html, $replacements);
    }
}


