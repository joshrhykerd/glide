<?php

namespace League\Glide;

use Mockery;

class ServerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServerFactory()
    {
        $this->assertInstanceOf('League\Glide\ServerFactory', new ServerFactory());
    }

    public function testGetServer()
    {
        $server = new ServerFactory([
            'source' => Mockery::mock('League\Flysystem\FilesystemInterface'),
            'cache' => Mockery::mock('League\Flysystem\FilesystemInterface'),
            'response' => Mockery::mock('League\Glide\Responses\ResponseFactoryInterface'),
        ]);

        $this->assertInstanceOf('League\Glide\Server', $server->getServer());
    }

    public function testGetSource()
    {
        $server = new ServerFactory([
            'source' => Mockery::mock('League\Flysystem\FilesystemInterface'),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getSource());

        $server = new ServerFactory([
            'source' => sys_get_temp_dir(),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getSource());
    }

    public function testGetSourcePathPrefix()
    {
        $server = new ServerFactory([
            'source_path_prefix' => 'source',
        ]);

        $this->assertSame('source', $server->getSourcePathPrefix());
    }

    public function testGetCache()
    {
        $server = new ServerFactory([
            'cache' => Mockery::mock('League\Flysystem\FilesystemInterface'),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getCache());

        $server = new ServerFactory([
            'cache' => sys_get_temp_dir(),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getCache());
    }

    public function testGetCachePathPrefix()
    {
        $server = new ServerFactory([
            'cache_path_prefix' => 'cache',
        ]);

        $this->assertSame('cache', $server->getCachePathPrefix());
    }

    public function testGetWatermarks()
    {
        $server = new ServerFactory([
            'watermarks' => Mockery::mock('League\Flysystem\FilesystemInterface'),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getWatermarks());

        $server = new ServerFactory([
            'watermarks' => sys_get_temp_dir(),
        ]);

        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $server->getWatermarks());
    }

    public function testGetWatermarksPathPrefix()
    {
        $server = new ServerFactory([
            'watermarks_path_prefix' => 'watermarks',
        ]);

        $this->assertSame('watermarks', $server->getWatermarksPathPrefix());
    }

    public function testGetApi()
    {
        $server = new ServerFactory();

        $this->assertInstanceOf('League\Glide\Api\Api', $server->getApi());
    }

    public function testGetImageManager()
    {
        $server = new ServerFactory();
        $imageManager = $server->getImageManager();

        $this->assertInstanceOf('Intervention\Image\ImageManager', $imageManager);
        $this->assertSame('gd', $imageManager->config['driver']);
    }

    public function testGetManipulators()
    {
        $server = new ServerFactory();
        $manipulators = $server->getManipulators();

        $this->assertInternalType('array', $manipulators);
        $this->assertInstanceOf('League\Glide\Manipulators\ManipulatorInterface', $manipulators[0]);
    }

    public function testGetMaxImageSize()
    {
        $server = new ServerFactory([
            'max_image_size' => 100,
        ]);

        $this->assertSame(100, $server->getMaxImageSize());
    }

    public function testGetDefaults()
    {
        $defaults = [
            'fm' => 'jpg',
        ];

        $server = new ServerFactory([
            'defaults' => $defaults,
        ]);

        $this->assertSame($defaults, $server->getDefaults());
    }

    public function testGetPresets()
    {
        $presets = [
            'small' => [
                'w' => 500,
            ],
        ];

        $server = new ServerFactory([
            'presets' => $presets,
        ]);

        $this->assertSame($presets, $server->getPresets());
    }

    public function testGetBaseUrl()
    {
        $server = new ServerFactory([
            'base_url' => 'img/',
        ]);

        $this->assertSame('img/', $server->getBaseUrl());
    }

    public function testGetResponseFactory()
    {
        $server = new ServerFactory([
            'response' => Mockery::mock('League\Glide\Responses\ResponseFactoryInterface'),
        ]);

        $this->assertInstanceOf('League\Glide\Responses\ResponseFactoryInterface', $server->getResponseFactory());
    }

    public function testCreate()
    {
        $server = ServerFactory::create([
            'source' => Mockery::mock('League\Flysystem\FilesystemInterface'),
            'cache' => Mockery::mock('League\Flysystem\FilesystemInterface'),
            'response' => Mockery::mock('League\Glide\Responses\ResponseFactoryInterface'),
        ]);

        $this->assertInstanceOf('League\Glide\Server', $server);
    }
}
