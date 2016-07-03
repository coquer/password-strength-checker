# Strength Password Provider
[![Latest Stable Version](https://poser.pugx.org/jycr753/password-strength-checker/v/stable)](https://packagist.org/packages/jycr753/password-strength-checker)
[![Total Downloads](https://poser.pugx.org/jycr753/password-strength-checker/downloads)](https://packagist.org/packages/jycr753/password-strength-checker)
[![Latest Unstable Version](https://poser.pugx.org/jycr753/password-strength-checker/v/unstable)](https://packagist.org/packages/jycr753/password-strength-checker)
[![License](https://poser.pugx.org/jycr753/password-strength-checker/license)](https://packagist.org/packages/jycr753/password-strength-checker)
[![Monthly Downloads](https://poser.pugx.org/jycr753/password-strength-checker/d/monthly)](https://packagist.org/packages/jycr753/password-strength-checker)

## Documentation
### Installation
To install run composer: 

    composer require jycr753/password-strength-checker

Register the service provider: 

    jycr753\PasswordStrengthChecker\ServiceProvider::class,
    
Publish the configuration files to customize the package:

    php artisan vendor:publish --provider="Vendor\jycr753\PasswordStrengthChecker\ServiceProvider" --tag="config"
    
### Usage

Import package in class

   `use jycr753\PasswordStrengthChecker\ServiceProvider as PSC;`

Method usage Sample:
 
    public function passwordCheck(Request $request)
    {
        $password = $request->get('password');
        $score = PSC::check($password);
        return [$score];
    }
 
 Output sample:
 
     [
         {
             "data": {
                 "score": 104,
                 "strength": 4,
                 "text": "Very Strong"
             }
         }
     ]

### Configuration

## Contributing

### Bug Reports
All issues are welcome, to create a better product, but your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue.

### Which Branch?
All bug fixes should be sent to the develop branch. Bug fixes should never be sent to the master

### Security Vulnerabilities
If you discover a security vulnerability within this package, write an email to Ageras developer@jorgerodriguez.dk .

### Coding Style
Our projects follows the PSR-2 coding standard and the [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) autoloading standard.

### StyleCI
 StyleCI automatically fixes code style to match the standard.

## License

	Copyright 2016 Jorge Rodriguez(jycr753) and other contributors:
	
	Permission is hereby granted, free of charge, to any person 
	obtaining a copy of this software and associated documentation 
	files (the "Software"), to deal in the Software without restriction, 
	including without limitation the rights to use, copy, modify, merge,
	publish, distribute, sublicense, and/or sell copies of the Software, 
	and to permit persons to whom the Software is furnished to do so, 
	subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included 
	in all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
	OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
	THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR 
	OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
	ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR 
	OTHER DEALINGS IN THE SOFTWARE.
