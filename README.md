
# API Documentation

This documentation provides an overview of the available endpoints in the API.

## Authentication

To access the protected endpoints, you need to authenticate using the `generate-token` endpoint.

### Generate Token

- **URL**: `/generate-token`
- **Method**: `POST`
- **Description**: Generates an authentication token.
- **Parameters**: None
- **Returns**: The generated token.

## Endpoints

The following endpoints require authentication using the generated token.

### Lab Test

- **URL**: `/lab-tests`
- **Method**: `GET`
- **Description**: Retrieve all lab tests.
- **Parameters**: None
- **Returns**: A list of lab tests.

### X-Ray

- **URL**: `/x-rays`
- **Method**: `GET`
- **Description**: Retrieve all X-rays.
- **Parameters**: None
- **Returns**: A list of X-rays.

- **URL**: `/x-rays`
- **Method**: `POST`
- **Description**: Create a new X-ray.
- **Parameters**:
  - `name` (string): The name of the X-ray.
- **Returns**: The created X-ray.

### Ultrasound

- **URL**: `/ultrasounds`
- **Method**: `GET`
- **Description**: Retrieve all ultrasounds.
- **Parameters**: None
- **Returns**: A list of ultrasounds.

- **URL**: `/ultrasounds`
- **Method**: `POST`
- **Description**: Create a new ultrasound.
- **Parameters**:
  - `name` (string): The name of the ultrasound.
- **Returns**: The created ultrasound.

### CT Scan

- **URL**: `/ctscans`
- **Method**: `GET`
- **Description**: Retrieve all CT scans.
- **Parameters**: None
- **Returns**: A list of CT scans.

- **URL**: `/ctscans`
- **Method**: `POST`
- **Description**: Create a new CT scan.
- **Parameters**:
  - `name` (string): The name of the CT scan.
- **Returns**: The created CT scan.

### MRI

- **URL**: `/mris`
- **Method**: `GET`
- **Description**: Retrieve all MRIs.
- **Parameters**: None
- **Returns**: A list of MRIs.

- **URL**: `/mris`
- **Method**: `POST`
- **Description**: Create a new MRI.
- **Parameters**:
  - `name` (string): The name of the MRI.
- **Returns**: The created MRI.

### Medical Record

- **URL**: `/medical-records`
- **Method**: `POST`
- **Description**: Create a new medical record.
- **Parameters**:
  - `patient_id` (integer): The ID of the patient.
  - `patient_name` (string): The name of the patient.
  - `mri_id` (integer): The ID of the MRI.
  - `mri_name` (string): The name of the MRI.
  - `ctscan_id` (integer): The ID of the CT scan.
  - `ctscan_name` (string): The name of the CT scan.
  - `xrays` (array): An array of X-rays.
    - `xray_id` (integer): The ID of the X-ray.
    - `name` (string): The name of the X-ray.
  - `ultrasounds` (array): An array of ultrasounds.
    - `ultrasound_id` (

integer): The ID of the ultrasound.
    - `name` (string): The name of the ultrasound.
- **Returns**: The created medical record.

Please note that authentication using the generated token is required for accessing the protected endpoints.

# GraphQL API Documentation

This documentation provides an overview of the available GraphQL mutations and queries in the API.

## Mutations

### Store Medical Record

- **Description**: Creates a new medical record.
- **Mutation**:
graphql
mutation {
  storeMedicalRecord(medical_record: {
    patient_id: 1,
    patient_name: "Samuel Aidoo",
    ctscan_id: 2,
    ctscan_name: "Ctscan 1",
    mri_id: 3,
    mri_name: "Mri 1",
    xrays: [
      {
        name: "XRay 1",
        xray_id: 4
      },
      {
        name: "XRay 2",
        xray_id: 5
      }
    ],
    ultrasounds: [
      {
        name: "Ultrasound 1",
        ultrasound_id: 6
      },
      {
        name: "Ultrasound 2",
        ultrasound_id: 7
      }
    ]
  }) 
}

## Queries

### Lab Tests

- **Description**: Retrieves information about lab tests, including their X-rays, ultrasounds, CT scans, and MRIs.
- **Query**:
graphql
{
  LabTests {
    xrays {
      name
    }
    ultrasounds {
      name
    }
    ctscans {
      name
    }
    mris {
      name
    }
  }
}


