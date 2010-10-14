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
Enable loading of the Google Analytics service by adding the following to the application's 
`config.yml` file
		google.analytics:
  		trackers:
    		shop:
      		name: MyJavaScriptCompatibleVariableNameWithNoSpaces
      		accountId: UA-xxxx-x
      		domain: .mydomain.com

#### View
Include the Google Analytics Async template like this
	{% include "GoogleBundle:Analytics:async" with ['_view': _view] %}

### Google Adwords

#### Application config.yml
Enable loading of the Google Adwords service by adding the following to the applications's 
`config.yml` file
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

#### View
Include the Google Adwords tracking template like this
		{% include "GoogleBundle:Adwords:track" with ['_view': _view] %}
