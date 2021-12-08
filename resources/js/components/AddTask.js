import React, { useState } from 'react';
import { Button, Form } from 'react-bootstrap';

function AddTask({ addTask }) {
    const [value, setValue] = useState("");
    const [error, setError] = useState(false);
  
    const handleSubmit = e => {
      e.preventDefault();
      if (!value) {
        setError(true)
      }else{
        addTask(value);
        setValue("");
        setError(false);
      }
    };
  
    return (
      <Form onSubmit={handleSubmit}> 
        <Form.Group>
          <Form.Label><b>Add Task</b></Form.Label>
          <Form.Control type="text" className="input" value={value} onChange={e => setValue(e.target.value)} placeholder="Add new task" />
        </Form.Group>
        { error &&  <p className="text-danger"> Title is required</p>}
        <div className="row">
          <div className="col text-center">
            <Button variant="primary mb-3 mt-3" type="submit">
              Submit
            </Button>
          </div>
        </div>
        
      </Form>
    );
}

export default AddTask;