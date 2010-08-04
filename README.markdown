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

### Application config.yml

#### Google Analytics
Enable loading of the Google Analytics service by adding the following to the application's
`config.yml` file:

    google.analytics: 
	  trackers: 
        shop:
          name: MyJavaScriptCompatibleVariableNameWithNoSpaces
          accountId: UA-xxxx-x
          domain: .mydomain.com
