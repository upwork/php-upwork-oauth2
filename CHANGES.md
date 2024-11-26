# Release History

## 2.5.0
* Remove calls to the legacy APIs

## 2.4.3
* Fix - Update refresh_token when doing Refresh Token Grant flow

## 2.4.2
* Bug fixes

## 2.4.1
* Bug fixes

## 2.4.0
* Add support of Client Credentials Grant

## 2.3.1
* Bug fixes

## 2.3.0
* Add GraphQL support

## 2.2.0
* Send Message to a Batch of Rooms API
* Milestones::delete was replaced with Milestones::deleteMilestone (breaking!)
* Fixed Workdays API
* Stop supporting deprecated Teamrooms API
* Migrate tests
* Bug fixes

## 2.1.1
* Add Room Messages API
* Sync-up routers with OAuth1 version

## 2.1.0
* Add Specialties API
* Add Skills V2 API

## 2.0.1
* Set library User-Agent

## 2.0.0
* OAuth2 release

## 1.2.3
* Applications API has moved from v3 to v4

## 1.2.2
* Fixed a typo in Send a Message to a Room API

## 1.2.1
* Bug fixes in Messages and Submissions API

## 1.2.0
* Added Messages API (new)
* Message API (V1) is now fully depricated

## 1.1.1
* Add optional parameter to support pagination in getTrayByType

## 1.1.0
* Get Categories (V1) is now fully depricated
* Added new Activities API - Assign to specific engagement the list of activities

## 1.0.1
* Added new Workdays API - Get Workdays by Comppany
* Added new Workdays API - Get Workdays by Contract

## 1.0.0
* welcome to Upwork!

## 0.1.21
* Added new Snapshot API - Get Snapshot by Contract
* Added new Snapshot API - Update Snapshot memo by Contract
* Added new Snapshot API - Delete Snapshot by Contract

## 0.1.20
* Added new Offer API - Accept or decline an offer

## 0.1.19
* Added new Metadata API - List categories (v2)
* Added new Workdiary API - Get Work Diary by Contract

## 0.1.18
* Added new Milestone API - Get Active Milestone for specific Contract
* Added new Milestone API - Get all Submissions for specific Milestone
* Added new Milestone API - Create a new Milestone
* Added new Milestone API - Edit the Milestone
* Added new Milestone API - Approve the Milestone
* Added new Milestone API - Activate the Milestone
* Added new Milestone API - Delete the Milestone
* Added new Submission API - Submit for Approval
* Added new Submission API - Approve the Submission
* Added new Submission API - Reject the Submission

## 0.1.17
* a release for packagist (composer)

## 0.1.16
* Added new call for Referenced User API

## 0.1.15
* Added new API - Suspend Contract
* Added new API - Resume Contract
* Un/archive Activities start supporting a list of codes
* Update OAuthPHPLib auth layer to support its usage in web example
without need to modify example dirrectly, i.e. unify response
of $client->getRequestToken()

## 0.1.14
* Fixed a typo in MC API for contexts

## 0.1.13
* Deprecated Get Full List in oTasks API
* Deprecated Delete Codes in oTasks API
* Deprecated company's level in oTasks API
* Added new API - Get MC Thread by Context
* Added new API - Get Last Posts by Context
* Fixed Assign engagements to the list of activities

## 0.1.12
* Added archive/unarchive oTasks API
* Added Get Codes by Activity for oTasks
* Deprecated Get Codes for specific user in oTasks API
* Fixed Client Job Applications API

## 0.1.11
* Code cleanup - drop unsupported API

## 0.1.10
* Fixed Snapshot API

## 0.1.9
* Fixed terminology: Otasks renamed to Activites

## 0.1.8
* Added PHPUnit tests
* Some wording changes

## 0.1.7
* Added oTasks API

## 0.1.6
* Fixed Workdiary API
* Fixed Teams API
* Added an example, based on php-oauth client library

## 0.1.5
* Added Snapshot API
* Added Team API
* Added Workdiary API

## 0.1.4
* Added Search Jobs and Providers API
* Added get Provider Profile and get Job Profile API
* Added Metadata API
* Added Organization API

## 0.1.3
* Added all Hiring API

## 0.1.2
* Added support of all MC API
* Added Custom Payments API
* Added Financial Reporting
* Added Time Reports

## 0.1.1
* LICENSE file added
* Fixes in README

## 0.1.0
* Initial release, working library that provides access to
a few common API (Get My Info, Get MC Trays, Post/Reply a Message)
