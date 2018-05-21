```
query {  
  users(fsp: {
    paginate: {
      number: 10,
      size: 50,
    },
    sort: [
      {by: "field_1", direction: DESC},
      {by: "field_2", direction: ASC},
    ],
    filter: 
      {or: [
        {or: [
          {and: [
            {between: {field: "field_1", min: "2018-01-01", max: "2018-12-31"}}
            {compare: {field: "field_2", comparator: GREAT_THAN, value: "500"}}
            {empty: {field: "field_3", empty: true}}
            {empty: {field: "field_4", empty: false}}
            {equals: {field: "field_5", value: "value"}}
            {fulltextSearch: {field: "field_6", search: "hello world"}}
            {in: {field: "field_7", values: ["1", "2", "3", "4", "five", "six"]}}
            {wildcard: {field: "field_8", wildcard: "*hello ?????!"}}
            {notBetween: {field: "field_9", min: "100", max: "200"}}
            {notEquals: {field: "field_10", value: "not-value"}}
            {notIn: {field: "field_11", values: ["9", "8", "7"]}}
            {notWildcard: {field: "field_12", wildcard: "*hello ?????!"}}
          ]}
          {and: [
            {compare: {field: "field_1", comparator: LESS_THAN, value: "10000"}}
            {empty: {field: "field_1", empty: false}}
          ]}
        ]}
        {between: {field: "datetime", min: "2018-01-01", max: "2018-12-31"}}
      ]}
  }) {
    field_1
    field_2
  }
}
```