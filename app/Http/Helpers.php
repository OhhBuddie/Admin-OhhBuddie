<?php
if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}

if (!function_exists('uploaded_asset')) {
    function uploaded_asset($fileName, $type = false)
    {
        // Define the base URL of the external server
        $env_URL = 'https://www.showloom.com/'; // Replace this with the base URL of the external site

        // Define the default file path for uploads
        $filePath = 'uploads/all';

        // Check the type to generate the correct path
        if ($type == 'large') {
            $path = $env_URL . $filePath . '/large/' . basename($fileName);
        } elseif ($type == 'medium') {
            $path = $env_URL . $filePath . '/medium/' . basename($fileName);
        } elseif ($type == 'small') {
            $path = $env_URL . $filePath . '/small/' . basename($fileName);
        } else {
            $path = $env_URL . $filePath . '/' . basename($fileName);
        }

        // Verify if the file exists by sending a HEAD request or return the placeholder
        try {
            $headers = @get_headers($path);
            if ($headers && strpos($headers[0], '200')) {
                return $path;
            } else {
                return static_asset('https://www.showloom.com/assets/img/placeholder.jpg'); // Placeholder image
            }
        } catch (Exception $e) {
            return static_asset('https://www.showloom.com/assets/img/placeholder.jpg'); // Return placeholder in case of an error
        }
    }
}

if (!function_exists('new_uploaded_asset')) {
    function new_uploaded_asset($id, $type = false)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            $env_URL = env('APP_URL', 'https://your-default-url.com'); // Dynamically fetch your app's base URL

            if ($asset->file_for != 'product' || $asset->domain == "") {
                return uploaded_asset($id, $type);
            } else {
                $fileName = basename($asset->file_name);
                $basePath = base_path('subdomains/media/uploads/all'); // Base path for media uploads

                if ($type == 'medium') {
                    if (file_exists($basePath . '/medium/' . $fileName)) {
                        return $asset->domain . '/uploads/all/medium/' . $fileName;
                    } else {
                        return $asset->domain . '/' . $asset->file_name;
                    }
                } elseif ($type == 'small') {
                    if (file_exists($basePath . '/small/' . $fileName)) {
                        return $asset->domain . '/uploads/all/small/' . $fileName;
                    } else {
                        return $asset->domain . '/' . $asset->file_name;
                    }
                } else {
                    if (file_exists($basePath . '/' . $fileName)) {
                        return $asset->domain . '/uploads/all/' . $fileName;
                    } else {
                        return $env_URL . '/' . $asset->file_name;
                    }
                }
            }
        }
        return static_asset('assets/img/placeholder.jpg');
    }
}