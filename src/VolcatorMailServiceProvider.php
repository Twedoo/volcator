<?php

namespace Twedoo\Volcator;

use Illuminate\Mail\MailManager;
use Illuminate\Mail\MailServiceProvider as ServiceProvider;
use Illuminate\Mail\Markdown;
use DB;

class VolcatorMailServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerIlluminateMailer();
        $this->registerMarkdownRenderer();
    }

    /**
     * Register the Illuminate mailer instance.
     *
     * @return void
     */
    protected function registerIlluminateMailer()
    {
        $this->app->singleton('mail.manager', function ($app) {
            return new MailManager($app);
        });

        $this->app->bind('mailer', function ($app) {
            return $app->make('mail.manager')->mailer();
        });
    }

    /**
     * Register the Markdown renderer instance.
     *
     * @return void
     */
    protected function registerMarkdownRenderer()
    {
        if (!$this->app->runningInConsole()) {
            config([
                'params' => DB::table('parameters')->where('name', 'like', '%TW_APP_%')->get()->keyBy('name')->transform(function ($setting) {
                    return $setting->value;
                })->toArray()
            ]);

            $this->app->singleton(Markdown::class, function ($app) {
                $config = $app->make('config');
                $markdown = (array) resource_path('views/back/'.config()["params"]["TW_APP_TEMPLATE_BACK"].'/'.current($config->get('volcator.markdown.paths')));

                return new Markdown($app->make('view'), [
                    'theme' => $config->get('volcator.markdown.theme', 'default'),
                    'paths' => $markdown,
                ]);
            });
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'mail.manager',
            'mailer',
            Markdown::class,
        ];
    }
}
