# GoogleBundle

## Installation

### Application Kernel

Add GoogleBundle to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new Bundle\GoogleBundle\GoogleBundle(),
        );
    }

## Configuration

### Google Analytics

#### Application config.yml
Enable loading of the Google Analytics service by adding the following to the application's `config.yml` file:
- - -
    google.analytics:
      trackers:
        default:
          name: MyJavaScriptCompatibleVariableNameWithNoSpaces
          accountId: UA-xxxx-x
          domain: .mydomain.com

in xml:
- - -
  <google:analytics>
    <google:trackers>
      <google:shop name="MyJavaScriptCompatibleVariableNameWithNoSpaces" accountId="UA-xxxx-x" domain=".mydomain.com"/>
    </google:trackers>
  </google:analytics>

#### View
Include the Google Analytics Async template like this with twig
    {% include "GoogleBundle:Analytics:async" with ['_view': _view] %}

for php
    <?php echo $view->render("GoogleBundle:Analytics:async.php") ?>

#### Features
* Logging a Default Page View requires no additional code
* Sending a Custom Page View
- - -
    $this->container()->get('google.analytics')->setCustomPageView('/profile/'.$username);
* Adding to Page View Queue
** Note: Page View Queue is always executed before a Custom Page View)
- - -
    $this->container()->get('google.analytics')->addPageViewQueue('/my-first-page-view-in-queue');
    $this->container()->get('google.analytics')->addPageViewQueue('/my-second-page-view-in-queue');

### Google Adwords

#### Application config.yml
Enable loading of the Google Adwords service by adding the following to the applications's `config.yml` file:
- - -
    google.adwords:
      originator:
        lifetime: 86400
      conversions:
        account_create:
          id:    111111
          label: accountCreateLabel
          value: 0
        checkout_thanks:
          id:    222222
          label: checkoutThanksLabel
          value: 0

#### Controller
    $this->container->get('google.adwords')->setConversionByPage('account_create');

#### View
Include the Google Adwords tracking template like this
    {% include "GoogleBundle:Adwords:track" with ['_view': _view] %}
